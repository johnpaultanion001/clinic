<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\User;
use App\Database;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use File;

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
    public function patientform(){
        return view('auth.registerpatient');
    }
    public function storeform(Request $request){
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:3'],
            'address' => ['required', 'string', 'max:555'],
            'brgy' => ['required', 'string', 'max:555'],
            'unit' => ['nullable', 'string', 'max:555'],
            'floor' => ['nullable', 'string', 'max:555'],
            'bn' => ['nullable', 'string', 'max:555'],
            'hb' => ['nullable', 'string', 'max:555'],
            'street' => ['nullable', 'string', 'max:555'],
            'village' => ['nullable', 'string', 'max:555'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'string', 'min:8','max:11','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_img' => ['required' , 'mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        $databases = Database::select(['name'])->get()->toArray();

        if (in_array(array('name' => $request->name), $databases))
        { 
            $imgs = $request->file('id_img');
            $extension = $imgs->getClientOriginalExtension(); 
            $file_name_to_save = "id" ."_".time()."_".$request->name.".".$extension;
            $imgs->move('img/id', $file_name_to_save);

            $user = new User();
            $user->name = $request->name;
            $user->age = $request->age;
            $user->address = $request->unit." ".$request->floor." ".$request->bn." ".$request->hb." ".$request->street." ".$request->village." ".", Brgy. ".$request->brgy. " " . $request->address;
            $user->email = $request->email;
            $user->contact_number = $request->contact_number;
            $user->password = hash::make($request->password);
            $user->id_image = 'img/id/'.$file_name_to_save;
            $user->save();
            Auth::login($user);
            if (Auth::user()){
                return response()->json(['success' => 'Data Added successfully.']);
            }   
        }
        
        return response()->json(['notindatabases' => 'Account not found: you are not  registered to the  list of this site']);
        
    }
}
