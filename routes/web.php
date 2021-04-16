<?php

Route::redirect('/', '/home');

  Route::get('admin/today', function () {
      if (session('status')) {
          return redirect()->route('admin.today')->with('status', session('status'));     
         }

      return redirect()->route('admin.today');
  });

Route::get('home', 'HomeController@index')->name('home');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::post('contact', 'HomeController@postcontact')->name('feedback');
Route::get('about', 'HomeController@about')->name('about');
Route::get('register-patient', 'HomeController@patientform')->name('patientform');
Route::post('storeform', 'HomeController@storeform')->name('storeform');



Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('today', 'HomeController@index')->name('today');

    Route::get('about', 'HomeController@about')->name('about');
    //Route::get('transaction', 'HomeController@transaction')->name('transaction');
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

    // databases
    Route::resource('databases', 'DatabaseController');

    // Purposes
    Route::resource('purposes', 'PurposeController');

    //announcement
    Route::resource('announcements', 'AnnouncementController');

    //about us
    Route::resource('aboutus', 'AboutUsController');

     //contacts
    Route::resource('contacts', 'ContactController');

    //holidays
    Route::resource('holidays', 'HolidayController');

    //fulldates
    Route::resource('fulldates', 'FullDateController');

    //feedbacks
    Route::resource('feedbacks', 'FeedbackController');

   

    //client schedule
    Route::resource('schedule', 'ScheduleController');   
    Route::post('schedule-filter',  'ScheduleController@filterbydate')->name('schedule.filterbydate');

    //transaction
    Route::get('transaction',  'ScheduleController@list')->name('schedule.list');
    Route::post('transaction-filter',  'ScheduleController@filtertrasaction')->name('transaction.filterbydatetransaction');


    Route::put('schedule-cancel/{id}',  'ScheduleController@cancel')->name('schedule.cancel');
    Route::delete('schedules/destroy', 'ScheduleController@massDestroy')->name('schedule.massDestroy');
    Route::get('errordata/{error}', 'ScheduleController@errordata');

    //History 
    Route::get('histories', 'HistoryController@index')->name('histories.index');
    Route::post('histories-filter',  'HistoryController@filterbydate')->name('histories.filterbydate');
    Route::delete('histories/destroy', 'HistoryController@massDestroy')->name('histories.massDestroy');


    //Scheduled List 
    Route::resource('scheduled-list', 'ScheduledListController');
    Route::post('schedule-list-filter',  'ScheduledListController@filterbydate')->name('scheduled-list.filterbydate');

    //user client
    Route::get('user-client/{user}/edit',  'UserClientController@edit')->name('user-client.edit');
    Route::put('user-client/{user}',  'UserClientController@update')->name('user-client.update');


});
