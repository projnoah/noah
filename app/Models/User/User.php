<?php

namespace Noah;

use Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser {

    /*
    |------------------------------------------------------------
    | User Model Class
    | 用户 模型类
    |------------------------------------------------------------
    | 
    | @project Project Noah
    | @author Cali
    |
    */
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     * @author Cali
     */
    protected $fillable = [
        'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     * 
     * @author Cali
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
