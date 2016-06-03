<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Photo extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'original_filename', 'extension', 'user_id', 'post_id', 'mime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}