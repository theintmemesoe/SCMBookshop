<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Mail\VerifyMail;
use Mail;

class UserController extends Controller
{
    public function getRegister(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $dob   = $request->dob;
        $profile= $request->profile;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required',
            'password-confirm' => 'required|same:password',
            'phone' => 'required',
            'dob' => 'required',
            'profile' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                              ->withInput();
        }

        $user=new User();
        $user->name=$name;
        $user->email=$email;
        $user->password=bcrypt($password);
        $user->type=1;
        $user->phone=$phone;
        $user->dob=$dob;
        $user->profile=$profile;
        $user->create_user_id = 1;
        $user->updated_user_id = 1;
        $user->save();

        $user_name = 'thesignoflove96@gmail.com';
        Mail::to($user['email'])->send(new VerifyMail($user_name));
        return $user_name;

        $profile = time().'.'.request()->profile->getClientOriginalExtension();
                request()->profile->move(public_path('myFile'), $profile);


        return redirect('/login')->with('info','Register success');
           
    }
    
}
