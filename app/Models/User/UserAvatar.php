<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class UserAvatar extends Model
{
    protected $fillable = [
        'type', 'src'
    ];

}