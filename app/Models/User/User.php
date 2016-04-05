<?php

namespace Noah;

use Noah\Library\Traits\User\Sociable;
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

    use Sociable;
    
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
     * The attributes that are excluded to present.
     *
     * @var array
     * 
     * @author Cali
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The user's avatar
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar()
    {
        return $this->hasOne(UserAvatar::class);
    }    
}