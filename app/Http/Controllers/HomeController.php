<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use Validator;

class HomeController extends Controller
{
   public function index()
    {
        return view('welcome');
    }
    public function contact()
    {
        return view('contact');
    }
    public function about()
    {
        return view('about');
    }
    public function postcontact(Request $request){
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:feedback'],
            'number' => ['required', 'string', 'min:8','max:11','unique:feedback'],
            'msg' => ['required'],
        ]);

        if ($errors->fails()) {
            return redirect('/contact')->with(['errors' => $errors->errors()]);
        }

        Feedback::create($request->all());
        return redirect('/contact')->with('success', 'Your feedback has been send it');
    }
}
