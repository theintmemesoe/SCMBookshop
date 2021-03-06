<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'create_user_id', 'updated_user_id', 'deleted_user_id', 'deleted_at',
    ];

}
