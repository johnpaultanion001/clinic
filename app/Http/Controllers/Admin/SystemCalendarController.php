<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Venue;
use Carbon\Carbon;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemCalendarController extends Controller
{
    public $sources = [
        // [
        //     'model'      => '\\App\\Event',
        //     'date_field' => 'start_time',
        //     'field'      => 'name',
        //     'prefix'     => 'Event',
        //     'suffix'     => '',
        //     'route'      => 'admin.events.edit',
        // ],
        // [
        //     'model'      => '\\App\\Meeting',
        //     'date_field' => 'start_time',
        //     'field'      => 'attendees',
        //     'prefix'     => 'Meeting with',
        //     'suffix'     => '',
        //     'route'      => 'admin.meetings.edit',
        // ],
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

        foreach ($this->sources as $source) {
            $calendarEvents = $source['model']::when(request('venue_id') && $source['model'] == '\App\Event', function($query) {
                return $query->where('venue_id', request('venue_id'));
            })->get();
            foreach ($calendarEvents as $model) {
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

        return view('admin.calendar.calendar', compact('events', 'venues'));
    }
}
