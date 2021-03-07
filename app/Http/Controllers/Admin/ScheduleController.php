<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Venue;
use Carbon\Carbon;
use App\User;
use App\Event;
use App\Schedule;
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
            'field'      => 'purpose',
            'prefix'     => 'Schedule',
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
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('client.schedule.schedule', compact('events', 'venues'));
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
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'required',
            ],
            'purpose' => 'required',

           
        ]);
        $userid = auth()->user()->id;

        $schedule = new Schedule();
        $schedule->user_id = $userid;
        $schedule->date_time = $request->date_time;
        $schedule->purpose = $request->purpose;
        
        $schedule->save();

        if($schedule){
            return response()->json("success");
            
        }else{
            return response()->json("error");
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
