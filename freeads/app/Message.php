<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Message extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'receiver_id', 'sender_id',
    ];
}
