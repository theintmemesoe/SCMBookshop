<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Contracts\Services\RegisterServiceInterface;
use Mail;
use App\Http\Controllers\Auth;
use App\Mail\VerifyMail;
use Illuminate\Auth\Events\Registered;

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
    private $registerService;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    
    
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct(RegisterServiceInterface $registerService)
        {
            $this->middleware('guest');
            $this->registerService = $registerService;
        }
    

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->sendRegisterMail($request->email);
        return redirect('login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required',
            'password-confirm' => 'required|same:password',
            'phone' => 'required',
            'dob' => 'required',
            'profile' => 'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return $this->registerService->create($data);
    }

    /**
     * Create a new controller instance to send email after a valid registration.
     *
     * @param  $email
     */
    public function sendRegistermail($email)
    {
        Mail::to($email)->send(new VerifyMail());
    }
}

