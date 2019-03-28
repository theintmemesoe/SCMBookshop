<?php

namespace App\Http\Controllers;

use App\User;
use Socialite;

class FacebookController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/login');
        }
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser = new User;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->provider_id = $user->id;
            $newUser->create_user_id = 1;
            $newUser->updated_user_id = 1;
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect('/home');

    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

}
