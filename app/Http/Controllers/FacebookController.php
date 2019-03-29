<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Socialite;

class FacebookController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'facebooklogout']]);
    }

    public function facebooklogout(\App\AuthenticateUser $authenticateUser, Request $request, $provider = null)
    {
        return $authenticateUser->deauthorize($this, $provider);
    }

    public function userHasLoggedOut()
    {
        return redirect('/login');
    }

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $create['name'] = $user->getName();

            $create['email'] = $user->getEmail();

            $create['provider_id'] = $user->getId();
            $create['create_user_id'] = 1;
            $create['updated_user_id'] = 1;
            $userModel = new User;

            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/login');
        }

    }

}
