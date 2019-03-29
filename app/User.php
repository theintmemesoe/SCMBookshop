<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'dob', 'profile', 'create_user_id', 'updated_user_id', 'provider', 'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function addNew($input)
    {
        $check = static::where('provider_id', $input['provider_id'])->first();
        if (is_null($check)) {
            return static::create($input);
        }
        return $check;
    }

    public function findByUserNameOrCreate($userData)
    {
        $user = User::where('provider_id', '=', $userData->id)->first();
        if (!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'name' => $userData->name,
                'email' => $userData->email,
                'provider' => 'facebook',
                'access_token' => $userData->token,
            ]);
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {

        $socialData = [
            'email' => $userData->email,
            'name' => $userData->name,
            'access_token' => $userData->token,
        ];
        $dbData = [
            'email' => $user->email,
            'name' => $user->name,
            'access_token' => $user->access_token,
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->email = $userData->email;
            $user->name = $userData->name;
            if ($userData != '') {
                $user->access_token = $userData->token;
            }
            $user->save();
        }
    }

}
