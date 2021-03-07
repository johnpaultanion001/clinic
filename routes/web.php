<?php

Route::redirect('/', '/login');
//  Route::get('/home', function () {
//      if (session('status')) {
//          return redirect()->route('admin.home')->with('status', session('status'));
//      }

//      return redirect()->route('admin.home');
//  });

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('today', 'HomeController@index')->name('today');

    Route::get('about', 'HomeController@about')->name('about');
    Route::get('transaction', 'HomeController@transaction')->name('transaction');
    Route::get('contact', 'HomeController@contact')->name('contact');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Venues
    Route::delete('venues/destroy', 'VenuesController@massDestroy')->name('venues.massDestroy');
    Route::resource('venues', 'VenuesController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventsController');

    // Meetings
    Route::delete('meetings/destroy', 'MeetingsController@massDestroy')->name('meetings.massDestroy');
    Route::resource('meetings', 'MeetingsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    
    //client schedule
    // Route::get('schedule', 'ScheduleController@index')->name('schedule.index');
    // Route::post('schedule', 'ScheduleController@store')->name('schedule.store');
    // Route::get('schedule', 'ScheduleController@edit')->name('schedule.edit');
    // Route::put('schedule', 'ScheduleController@update')->name('schedule.update');
    Route::resource('schedule', 'ScheduleController');   
    Route::get('getdata',  'ScheduleController@getdata');
    Route::get('schedule-list',  'ScheduleController@list')->name('schedule.list');
    Route::delete('schedules/destroy', 'ScheduleController@massDestroy')->name('schedule.massDestroy');
    Route::get('errordata/{error}', 'ScheduleController@errordata');
});
