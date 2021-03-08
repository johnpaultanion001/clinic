<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Venue;
use Carbon\Carbon;
use App\User;
use App\Event;
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
            'purpose'      => 'name',
            'prefix'     => 'You have scheduled in this date',
            'suffix'     => '',
            'route'      => 'admin.schedule.edit',
        ],
        
    ];

    public function index()
    {

        abort_if(Gate::denies('schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $events = [];

        $venues = Venue::all();

        $userid = auth()->user()->id;

        foreach ($this->sources as $source) {
            //  $calendarEvents = $source['model']::when(request('user_id') && $source['model'] == '\App\Schedule', function($query) {
            //      return $query->where($userid, $userid);
            //  })->get();

             $data = Schedule::where('user_id', $userid)
                        ->get();

            
            
            foreach ($data  as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => $model->{$source['field']} . " " . $model->purpose->{$source['purpose']},
                    'start' => $crudFieldValue, 
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }
        $purposes = Purpose::all();
        return view('client.schedule.schedule', compact('events', 'venues','purposes'));
    }

    public function list()
    {
        $schedules = Schedule::all();

        return view('client.schedule.list', compact('schedules'));
    }

    public function getdata(){

    	abort_if(Gate::denies('schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $events = [];

        $venues = Venue::all();

        $userid = auth()->user()->id;

        foreach ($this->sources as $source) {
            //  $calendarEvents = $source['model']::when(request('user_id') && $source['model'] == '\App\Schedule', function($query) {
            //      return $query->where($userid, $userid);
            //  })->get();

             $data = Schedule::where('user_id', $userid)
                        ->get();

            
            
            foreach ($data  as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('client.schedule.response', compact('events', 'venues'));
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

        
       
        //schedule table
        $schedule->user_id = $userid;
        $schedule->date_time = $request->date_time;
        $schedule->time = $request->time;
        $schedule->purpose_id = $request->purpose_id;
        $schedule->save();

        if($schedule){
            
            // $availabledate->date_scheduled = $request->date_time;
            // $availabledate->available_slots = 1;
            // $availabledate->max_slots = 5;
            // $availabledate->save();

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
        return view('client.schedule.edit')->with('schedule', $schedule);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back();
    }

    public function massDestroy(MassDestroyScheduleRequest $request)
    {
        Schedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
