<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\AvailableDate;
use App\Schedule;
use App\Purpose;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use App\Http\Requests\MassDestroyScheduleRequest;

class ScheduleController extends Controller
{
    public $sources = [
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

    public function index()
    {
        $events = [];
        $userid = auth()->user()->id;

        abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $userrole = auth()->user()->roles()->getQuery()->pluck('title')->first();
        if($userrole == 'Admin'){
            foreach ($this->sources as $source) {
                 $data = Schedule::where('isCancel', '0')        
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
            $purposes = Purpose::all();
            return view('client.schedule.schedule', compact('events','purposes'));
        }
        foreach ($this->sources as $source) {
             $data = Schedule::where('user_id', $userid)
                            ->where('isCancel', '0')        
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
            return view('client.transaction', compact('schedules', 'purposes'));
        }else{
            $schedules = Schedule::where('user_id', $userid)
                                    ->where('isCancel', '0')        
                                    ->get();  
            $purposes = Purpose::latest()->get();
            return view('client.transaction', compact('schedules', 'purposes'));
        }
       
    }

    public function filterbydate(Request $request){
        abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
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
            foreach ($this->sources as $source) {

                $filterdate = Schedule::whereBetween('date_time', [$start, $end])
                                        ->where('isCancel', '0')
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
            $purposes = Purpose::all();
            return view('client.schedule.schedule', compact('events','purposes'));
         }
         foreach ($this->sources as $source) {
            $filterdate = Schedule::whereBetween('date_time', [$start, $end])
                                    ->where('user_id', $userid)
                                    ->where('isCancel', '0')
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
        abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $this->validate($request,[
                'date_time' => [
                    'date_format:' . config('panel.date_format') ,
                    'required',
                ],
                'time' => [
                    'required',
                ],
                'purpose_id' => 'required',

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
                                    ,"6:40 AM","7:00 AM","7:20 AM","7:40 AM","4:00 PM","4:20 PM","4:40 PM"
                                    ,"5:00 PM","5:20 PM","5:40 PM","6:00 PM","6:20 PM","6:40 PM","7:00 PM"
                                    ,"7:20 PM","7:40 PM","8:00 PM","8:20 PM","8:40 PM","9:00 PM","9:20 PM"
                                    ,"9:40 PM","10:00 PM","10:20 PM","10:40 PM","11:00 PM","11:20 PM","11:40 PM"); 

            if (in_array($request->time, $notofficetime))
            {
                return response()->json("notofficehr");
            }
            
            if($fulldate > 9){
                return response()->json("maxdate");
            }
            if($onedateuser > 0){
                return response()->json("onedate");
            }
            if($onedatebytime > 0){
                return response()->json("onetime");
            }
            $schedule->user_id = $userid;
            $schedule->date_time = $request->date_time;
            $schedule->time = $request->time;
            $schedule->purpose_id = $request->purpose_id;
            $schedule->save();

            if($schedule){
                return response()->json("success");
            }else{
                return response()->json(["error"]);
            }
        }catch (\Throwable $e) {
            $arr = array(
                'error' => 'Error, Problem with some code. Try again',
                'errorMessage' => $e->getMessage()
            );

            return response()->json($arr);
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
        abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $purposes = Purpose::all();
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
        abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->validate($request,[
            'date_time' => [
                'date_format:' . config('panel.date_format') ,
                'required',
            ],
            'time' => [
                'required',
            ],
            'purpose_id' => 'required',

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

     

        if (in_array($request->time, $notofficetime))
        {
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, The Clinic open time are 8:00 AM TO 4:00 PM ');
        }
        
        if($fulldate > 9){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, Your chosen date  is full');
        }
        if($onedateuser > 0){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, You have already scheduled in this date ');
        }
        if($onedatebytime > 0){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('error', 'Error, Your chosen time is not available');
        }
       

        //$schedule->user_id = $userid;
        $schedule->date_time = $request->date_time;
        $schedule->time = $request->time;
        $schedule->purpose_id = $request->purpose_id;
        $schedule->save();

        if($schedule){
            return redirect('admin/schedule/'.$schedule->id.'/edit')->with('success', 'Data Updated');
           
        }else{
            return response()->json(["error"]);
        }
    }

    public function cancel($id)
    {
        abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $schedule->delete();
        return back();
    }

    public function massDestroy(MassDestroyScheduleRequest $request)
    {
        abort_if(Gate::denies('schedule_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Schedule::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
