<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Log;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:6'],
    //         'password-confirm' => ['required','same:password'],
    //         'phone' => ['required'],
    //         'dob' => ['required'],
    //         'profile' => ['required'],
            
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'phone' => $data['phone'],
            // 'dob' => $data['dob'],
            // 'profile'=> $data['profile'],
            // 'create_user_id' => 1,
            // 'updated_user_id' => 1,
        ]);
        
        // $profile = time().'.'.request()->profile->getClientOriginalExtension();
        // request()->profile->move(public_path('myFile'), $profile);

        // return redirect('/login')->with('info','Register success');
    }

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

        // Mail::to($user['email'])->send(new WelcomeMail($user));
        //         return $user;
        $user->save();

         $user = 'thesignoflove96@gmail.com';
        Mail::to($user)->send(new WelcomeMail($user));
        return 'Email was sent';

        $profile = time().'.'.request()->profile->getClientOriginalExtension();
                request()->profile->move(public_path('myFile'), $profile);

        return redirect('/login')->with('info','Register success');
           
    }
    
}

