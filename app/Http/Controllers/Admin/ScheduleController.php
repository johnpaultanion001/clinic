<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Holiday;
use App\AvailableDate;
use App\Schedule;
use App\Purpose;
use App\FullDate;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use App\Http\Requests\MassDestroyScheduleRequest;
use datetime;

class ScheduleController extends Controller
{
    public $schedulesources = [
        [
            'model'      => '\\App\\Schedule',
            'date_field' => 'date_time',
            'field'      => 'time',
            'user'      => 'name',
            'purpose'      => 'name',
            'prefix'     => 'You have scheduled in this date',
            'suffix'     => '',
            'route'      => 'admin.schedule.edit',
        ],
    ];
    public $holidayssources = [
        [
            'model'      => '\\App\\Holiday',
            'date_holiday' => 'date_holiday',
            'name'      => 'name',
        ],
    ];

    public function index()
    {
        $events = [];
        $userid = auth()->user()->id;
        $today = new DateTime();
        //abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $userrole = auth()->user()->roles()->getQuery()->pluck('title')->first();
        if($userrole == 'Admin'){
             foreach ($this->schedulesources as $source) {
                 $schedules = Schedule::where('isCancel', '0')
                                        ->whereBetween('date_time', [Carbon::now()->subDays(1), "2022-03-12"])
                                        ->get();              
                 foreach ($schedules as $model) {
                     $crudFieldValue = $model->getOriginal($source['date_field']);
    
                     if (!$crudFieldValue) {
                         continue;
                     }
    
                     $events[] = [
                         'title' => $model->user->{$source['user']} . "-" .$model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                         'start' => $crudFieldValue, 
                         'url'   => route($source['route'], $model->id),
                         'backgroundColor' => '#008C1F',
                         'borderColor'    => '#008C1F',
                     ];
                 }
             }
            foreach ($this->schedulesources as $source) {
                $schedules = Schedule::where('isCancel', '0')
                                        ->whereBetween('date_time', ["2019-03-08",Carbon::now()->subDays(1)])
                                        ->get();              
                foreach ($schedules as $model) {
                    $crudFieldValue = $model->getOriginal($source['date_field']);
    
                    if (!$crudFieldValue) {
                        continue;
                    }
    
                    $events[] = [
                        'title' => 'Past Due'.' ' . $model->user->{$source['user']} . "-" .$model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                        'start' => $crudFieldValue, 
                        'textColor'    => '#fff',
                        'backgroundColor' => '#FF0000',
                        'borderColor'    => '#FF0000',
                    ];
                }
            }
            foreach ($this->holidayssources as $source) {
                $data = Holiday::all();
                foreach ($data as $models) {
                    $crudFieldValues = $models->getOriginal($source['date_holiday']);
    
                    if (!$crudFieldValues) {
                        continue;
                    }
    
                    $events[] = [
                        'title' => $models->{$source['name']},
                        'start' => $crudFieldValues, 
                        'backgroundColor' => '#FFFF00',
                        'textColor'    => '#111',
                    ];
                }
            }
            $purposes = Purpose::all();
            return view('client.schedule.schedule', compact('events','purposes'));
        }
        //Client
        foreach ($this->schedulesources as $source) {
             $data = Schedule::where('user_id', $userid)
                            ->where('isCancel', '0')
                            ->whereBetween('date_time', [Carbon::now()->subDays(1), "2022-03-12"])        
                            ->get();            
            foreach ($data  as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }
                $events[] = [
                    'title' => $model->user->{$source['user']} . "-" .$model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                    'start' => $crudFieldValue, 
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }
        foreach ($this->schedulesources as $source) {
                
            $schedules = Schedule::where('isCancel', '0')
                                 ->where('user_id', $userid)
                                ->whereBetween('date_time', ["2019-03-08", Carbon::now()->subDays(1)])
                                ->get();              
            foreach ($schedules as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => 'Past Due'.' ' . $model->user->{$source['user']} . "-" .$model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                    'start' => $crudFieldValue, 
                    'textColor'    => '#fff',
                    'backgroundColor' => '#FF0000',
                    'borderColor'    => '#FF0000',
                ];
            }
        }
        foreach ($this->holidayssources as $source) {
            $data = Holiday::all();
            foreach ($data as $models) {
                $crudFieldValues = $models->getOriginal($source['date_holiday']);

                if (!$crudFieldValues) {
                    continue;
                }

                $events[] = [
                    'title' => $models->{$source['name']},
                    'start' => $crudFieldValues, 
                    'backgroundColor' => '#FFFF00',
                    'textColor'    => '#111',
                ];
            }
        }
        $purposes = Purpose::all();
        return view('client.schedule.schedule', compact('events','purposes'));
    }

    public function list()
    {
        $userrole = auth()->user()->roles()->getQuery()->pluck('title')->first();
        $userid = auth()->user()->id;

        if($userrole == 'Admin'){
            $schedules = Schedule::latest()->get();
            $purposes = Purpose::latest()->get();
            return view('client.transactions.transaction-admin', compact('schedules', 'purposes'));
        }else{
            try{
                $schedules = Schedule::where('user_id', $userid)
                                        ->where('isCancel', '0')       
                                        ->orderBy('date_time', 'ASC')
                                        ->get();  
                $purposes = Purpose::latest()->get();

                if (!$schedules->isEmpty()){
                    $schedule = $schedules->first();
                    return view('client.transactions.transaction-client', compact('schedule', 'purposes'));
                }
                return redirect('admin/schedule')->with('error', 'Your transaction is empty , choose a schedule here');
              }
            catch(\Exception $e){
            return view('client.transactions.transaction-client')->with('error', $e->getMessage());
            
            }
        }
       
    }

    

    public function filtertrasaction(Request $request){
         $this->validate($request,[
                'date_from' => [
                    'required','date',
                ],
            ]);
            
        
        $end = Carbon::parse($request->date_from);
        $userrole = auth()->user()->roles()->getQuery()->pluck('title')->first();
        $userid = auth()->user()->id;

        if($userrole == 'Admin'){
            $schedules = Schedule::whereBetween('date_time', ["2019-03-12", $end])
                                 ->latest()
                                 ->get();

            $purposes = Purpose::latest()->get();
            return view('client.transactions.transaction-admin', compact('schedules', 'purposes'));
        }


    }

    public function filterbydate(Request $request){
        //abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
         $this->validate($request,[
             'date_from' => [
                'required','date','before_or_equal:date_to'
             ],
             'date_to' => [
                 'required','date',
              ],
            ]);

        $start = Carbon::parse($request->date_from);
        $end = Carbon::parse($request->date_to);
        $events = [];
        $userid = auth()->user()->id;
        $userrole = auth()->user()->roles()->getQuery()->pluck('title')->first();
        if($userrole == 'Admin'){
            foreach ($this->schedulesources as $source) {
                $filterdate = Schedule::whereBetween('date_time', [$start, $end])
                                        ->where('isCancel', '0')
                                        ->whereBetween('date_time', [Carbon::now()->subDays(1), "2022-03-12"])
                                        ->get();
                
                foreach ($filterdate as $model) {
                    $crudFieldValue = $model->getOriginal($source['date_field']);

                    if (!$crudFieldValue) {
                        continue;
                    }

                    $events[] = [
                        'title' => $model->user->{$source['user']} . "-" .$model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                        'start' => $crudFieldValue, 
                        'url'   => route($source['route'], $model->id),
                    ];
                }
            }
            foreach ($this->schedulesources as $source) {
                $schedules = Schedule::where('isCancel', '0')
                                        ->whereBetween('date_time', [$start, $end])
                                        ->whereBetween('date_time', ["2019-03-08",Carbon::now()->subDays(1)])
                                        ->get();              
                foreach ($schedules as $model) {
                    $crudFieldValue = $model->getOriginal($source['date_field']);
    
                    if (!$crudFieldValue) {
                        continue;
                    }
    
                    $events[] = [
                        'title' => 'Past Due'.' ' . $model->user->{$source['user']} . "-" .$model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                        'start' => $crudFieldValue, 
                        'textColor'    => '#fff',
                        'backgroundColor' => '#FF0000',
                        'borderColor'    => '#FF0000',
                    ];
                }
            }
            foreach ($this->holidayssources as $source) {
                $data = Holiday::all();
                foreach ($data as $models) {
                    $crudFieldValues = $models->getOriginal($source['date_holiday']);
    
                    if (!$crudFieldValues) {
                        continue;
                    }
    
                    $events[] = [
                        'title' => $models->{$source['name']},
                        'start' => $crudFieldValues, 
                        'backgroundColor' => '#FFFF00',
                        'textColor'    => '#111',
                    ];
                }
            }
            $purposes = Purpose::all();
            return view('client.schedule.schedule', compact('events','purposes'));
         }
         //client
        foreach ($this->schedulesources as $source) {
            $filterdate = Schedule::whereBetween('date_time', [$start, $end])
                                    ->where('isCancel', '0')
                                    ->where('user_id', $userid)
                                    ->whereBetween('date_time', [Carbon::now()->subDays(1), "2022-03-12"])
                                    ->get();
            
            foreach ($filterdate as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => $model->user->{$source['user']} . "-" .$model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                    'start' => $crudFieldValue, 
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }
        foreach ($this->schedulesources as $source) {
            $schedules = Schedule::where('isCancel', '0')
                                    ->whereBetween('date_time', [$start, $end])
                                    ->whereBetween('date_time', ["2019-03-08",Carbon::now()->subDays(1)])
                                    ->where('user_id', $userid)
                                    ->get();              
            foreach ($schedules as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => 'Past Due'.' ' . $model->user->{$source['user']} . "-" .$model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                    'start' => $crudFieldValue, 
                    'textColor'    => '#fff',
                    'backgroundColor' => '#FF0000',
                    'borderColor'    => '#FF0000',
                ];
            }
        }
        foreach ($this->holidayssources as $source) {
            $data = Holiday::all();
            foreach ($data as $models) {
                $crudFieldValues = $models->getOriginal($source['date_holiday']);

                if (!$crudFieldValues) {
                    continue;
                }

                $events[] = [
                    'title' => $models->{$source['name']},
                    'start' => $crudFieldValues, 
                    'backgroundColor' => '#FFFF00',
                    'textColor'    => '#111',
                ];
            }
        }
        $purposes = Purpose::all();
        return view('client.schedule.schedule', compact('events','purposes'));

    }

    public function errordata($error)
    {
        return view('client.schedule.errorData',['error' => $error]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
            $this->validate($request,[
                'date_time' => [
                    'date_format:' . config('panel.date_format') ,
                    'required',
                    'after:yesterday',
                ],
                'time' => [
                    'required',
                ],
                'purpose_id' => 'required',
                'purpose' => 'required',

            ]);
            $userid = auth()->user()->id;
            
            //$availabledate = new AvailableDate();
            $schedule = new Schedule();

            $onedateuser = Schedule::where('date_time', $request->date_time)
                                    ->where('user_id', $userid)
                                    ->where('isCancel', '0')
                                    ->get()->count();

            $onedatebytime = Schedule::where('date_time', $request->date_time)
                                    ->where('time', $request->time)
                                    ->where('isCancel', '0')
                                    ->get()->count();

            $fulldate = Schedule::where('date_time', $request->date_time)
                                ->where('isCancel', '0')
                                ->get()->count();
            
            $notofficetime = array("12:00 AM", "12:20 AM", "12:40 AM", "1:00 AM","1:20 AM","1:40 AM"
                                    ,"2:00 AM","2:20 AM","2:40 AM","3:00 AM","3:20 AM","3:40 AM","4:00 AM"
                                    ,"4:20 AM","4:40 AM","5:00 AM","5:20 AM","5:40 AM","6:00 AM","6:20 AM"
                                    ,"6:40 AM","7:00 AM","7:20 AM","7:40 AM",
                                    "5:00 PM","5:20 PM","5:40 PM","6:00 PM","6:20 PM","6:40 PM","7:00 PM"
                                    ,"7:20 PM","7:40 PM","8:00 PM","8:20 PM","8:40 PM","9:00 PM","9:20 PM"
                                    ,"9:40 PM","10:00 PM","10:20 PM","10:40 PM","11:00 PM","11:20 PM","11:40 PM"); 
            
            $holidays = Holiday::select(['date_holiday'])->get()->toArray();
            $max = FullDate::find(1);

            if (in_array($request->time, $notofficetime))
            {
                return response()->json("notofficehr");
            }
            if (in_array(array('date_holiday' => $request->date_time .' 00:00:00'), $holidays))
            {
                return response()->json("holidays");
            }
            if($fulldate > $max->fulldate -1){
                return response()->json("maxdate");
            }
            if($onedateuser > 0){
                return response()->json("onedate");
            }
            if($onedatebytime > 0){
                return response()->json("onetime");
            }
            date_default_timezone_set('Asia/Manila');
            if($request->date_time == date('Y-m-d')){
                return response()->json("today");
            }
            $schedule->user_id = $userid;
            $schedule->date_time = $request->date_time;
            $schedule->time = $request->time;
            $schedule->purpose_id = $request->purpose_id;
            $schedule->purpose_text = $request->purpose;
            $schedule->reference_number = time().'-'.$userid;
            
            
            $schedule->save();

            if($schedule){
                return response()->json("success");
            }else{
                return response()->json(["error"]);
            }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(schedule $schedule)
    {
        //abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $purposes = Purpose::all();
        if($schedule->isCancel == 1){
            return redirect('admin/transaction')->with('error', 'This schedule is cancel , can not edited');
        }
        if($schedule->isCancel == 2){
            return redirect('admin/transaction')->with('error', 'This schedule is done , can not edited');
        }
        return view('client.schedule.edit', compact('schedule' , 'purposes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, schedule $schedule)
    {
        //abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->validate($request,[
            'date_time' => [
                'date_format:' . config('panel.date_format') ,
                'required',
            ],
            'time' => [
                'required',
            ],
            'purpose_id' => 'required',
            'purpose' => 'required',

        ]);
        $userid = auth()->user()->id;
        $onedateuser = Schedule::where('date_time', $request->date_time)
                                ->where('user_id', $userid)
                                ->get()->count();

        $onedatebytime = Schedule::where('date_time', $request->date_time)
                                ->where('time', $request->time)
                                ->get()->count();

        $fulldate = Schedule::where('date_time', $request->date_time)->get()->count();
        
        $notofficetime = array("12:00 AM", "12:20 AM", "12:40 AM", "1:00 AM","1:20 AM","1:40 AM"
                                ,"2:00 AM","2:20 AM","2:40 AM","3:00 AM","3:20 AM","3:40 AM","4:00 AM"
                                ,"4:20 AM","4:40 AM","5:00 AM","5:20 AM","5:40 AM","6:00 AM","6:20 AM"
                                ,"6:40 AM","7:00 AM","7:20 AM","7:40 AM","4:00 PM","4:20 PM","4:40 PM"
                                ,"5:00 PM","5:20 PM","5:40 PM","6:00 PM","6:20 PM","6:40 PM","7:00 PM"
                                ,"7:20 PM","7:40 PM","8:00 PM","8:20 PM","8:40 PM","9:00 PM","9:20 PM"
                                ,"9:40 PM","10:00 PM","10:20 PM","10:40 PM","11:00 PM","11:20 PM","11:40 PM"); 

        $holidays = Holiday::select(['date_holiday'])->get()->toArray();
        $max = FullDate::find(1);

        if (in_array($request->time, $notofficetime))
        {
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, The Clinic open time are 8:00 AM TO 4:00 PM ');
        }
        if (in_array(array('date_holiday' => $request->date_time .' 00:00:00'), $holidays))
        {
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, Your chosen date is holiday');
        }
        if($fulldate > $max->fulldate -1){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, Your chosen date  is full');
        }
        if($onedateuser > 0){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, You have already scheduled in this date ');
        }
        if($onedatebytime > 0){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, Your chosen time is not available');
        }
        date_default_timezone_set('Asia/Manila');
        if($request->date_time == date('Y-m-d')){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, You can`t make schedule today');
        }
       

        //$schedule->user_id = $userid;
        $schedule->date_time = $request->date_time;
        $schedule->time = $request->time;
        $schedule->purpose_id = $request->purpose_id;
        $schedule->purpose_text = $request->purpose;
        $schedule->save();

        if($schedule){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('success', 'Data Updated');
           
        }else{
            return response()->json(["error"]);
        }
    }

    public function cancel($id)
    {
        //abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $schedule = Schedule::find($id);
        $schedule->isCancel = "1";
        $schedule->save();
        if($schedule){
            return redirect('admin/schedule')->with('success', 'Canceled Successfully');
        }else{
            return response()->json(["error"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $schedule->delete();
        return back();
    }

    public function massDestroy(MassDestroyScheduleRequest $request)
    {
        //abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Schedule::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
