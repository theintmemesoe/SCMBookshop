<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Socialite;

class AuthenticateUser extends Model
{
    public function deauthorize($listener)
    {
        if (Auth::check()) {
            Socialite::driver('facebook')->deauthorize(Auth::user()->remember_token);
            Auth::user()->remember_token = '';
            Auth::user()->save();
            Auth::logout();
            // $this->guard()->logout();
            return $listener->userHasLoggedOut();
        }
    }
}
