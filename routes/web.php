<?php

Route::redirect('/', '/home');

  Route::get('admin/today', function () {
      if (session('status')) {
          return redirect()->route('admin.today')->with('status', session('status'));     
         }

      return redirect()->route('admin.today');
  });

Route::get('home', 'HomeController@index')->name('home');

Auth::routes();

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

    // Purposes
    Route::resource('purposes', 'PurposeController');

    //announcement
    Route::resource('announcements', 'AnnouncementController');

    //about us
    Route::resource('aboutus', 'AboutUsController');

     //contacts
    Route::resource('contacts', 'ContactController');

    //client schedule
    Route::resource('schedule', 'ScheduleController');   
    Route::post('schedule-filter',  'ScheduleController@filterbydate')->name('schedule.filterbydate');
    Route::get('schedule-list',  'ScheduleController@list')->name('schedule.list');
    Route::put('schedule-cancel/{id}',  'ScheduleController@cancel')->name('schedule.cancel');
    Route::delete('schedules/destroy', 'ScheduleController@massDestroy')->name('schedule.massDestroy');
    Route::get('errordata/{error}', 'ScheduleController@errordata');


});
