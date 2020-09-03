<?php

namespace App;


class User extends \TCG\Voyager\Models\User
{

    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'name', 'last_name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}