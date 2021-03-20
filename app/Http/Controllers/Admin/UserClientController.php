<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class UserClientController extends Controller
{
    public function edit($user){
        $user = auth()->user()->id;

        $user = User::find($user);
       
        return view('client.users.edit', compact('user'));
        
    }
    public function update(Request $request, $user){
        try{
            $this->validate($request,[
                'name' => ['required', 'string', 'max:255'],
                'age' => ['required', 'string', 'max:3'],
                'address' => ['required', 'string', 'max:555'],
                'email' => ['required', 'string', 'email', 'max:255' ],
                'contact_number' => ['required', 'string', 'min:8','max:11'],
                'current_password' => ['required',new MatchOldPassword],
                'new_password' => ['required'],
                'confirm_password' => ['required','same:new_password'],
            ]);
            $user = auth()->user()->id;
            $user = User::find($user);       
            $user->name = $request->name;
            $user->age = $request->age;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->contact_number = $request->contact_number;
            $user->password = $request->new_password;
            $user->update();
            
            if($user){
                return redirect('admin/user-client/'.auth()->user()->id.'/edit')->with('success', 'Successfully Updated');
            }else{
                return response()->json(["error"]);
            }
        }catch(\Exception $e){
            return redirect('admin/user-client/'.auth()->user()->id.'/edit')->with('error', $e->getMessage());
        }
    }
}
