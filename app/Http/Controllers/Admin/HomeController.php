<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\Schedule;
use App\User;
use App\Contact;
use App\AboutUs;
use App\Announcement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class HomeController
{
    public function index()
    {
        $announcements = Announcement::latest()->get();
        $schedules = Schedule::all();
        $userrole = auth()->user()->roles()->getQuery()->pluck('title')->first();
        
        if($userrole == 'Admin'){
            User::findOrFail(auth()->user()->id)->roles()->sync(1);
            return view('client.today', compact('announcements','schedules'));
        }else{
            User::findOrFail(auth()->user()->id)->roles()->sync(2);
            return view('client.today', compact('announcements','schedules'));
        }
        
       
    }
    public function about()
    {
        abort_if(Gate::denies('about_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $abouts = AboutUs::latest()->get();
        return view('client.about', compact('abouts'));
    }
    public function transaction()
    {
        abort_if(Gate::denies('transaction_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('client.transactions.transaction-client');
    }
    public function contact()
    {
        abort_if(Gate::denies('contact_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contacts = Contact::latest()->get();
        return view('client.contact', compact('contacts'));
    }
}
