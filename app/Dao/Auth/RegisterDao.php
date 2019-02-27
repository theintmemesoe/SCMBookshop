<?php

namespace App\Dao\Auth;

use App\Contracts\Dao\Auth\RegisterDaoInterface;
use App\User;
use Auth;
use Config;

class RegisterDao implements RegisterDaoInterface
{
    /**
     * Authenticate register
     *
     * Authenticate for admin register
     * @param 
     * @return 
     */
    public function getRegister()
    {
        // $user=new User();
        // $user->name=$name;
        // $user->email=$email;
        // $user->password=bcrypt($password);
        // $user->type=1;
        // $user->phone=$phone;
        // $user->dob=$dob;
        // $user->profile=$profile;
        // $user->create_user_id = 1;
        // $user->updated_user_id = 1;
        // $user->save();
        // return redirect()->back()->with('info','Register success');
    }
}
