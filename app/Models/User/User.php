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
        'password', 'remember_token', 'social_info'
    ];

    /*
     * Relationships starts
     */

    /**
     * The user's avatar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     * @author Cali
     */
    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    /**
     * The user's roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * @author Cali
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /*
    * Relationships ends
    */

    /**
     * Fetch the user's avatar url.
     *
     * @return string
     *
     * @author Cali
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar->type === 0 ?
            url($this->avatar->src) :
            $this->avatar->src;
    }

    /**
     * Check if has a role.
     *
     * @param $role
     * @return bool
     *
     * @author Cali
     */
    public function hasRole($role)
    {
        if ($role instanceof Role) {
            return !!$this->roles()
                ->where($role->primaryKey, $role->id)
                ->first();
        }

        // If a string given
        return !!$this->roles()->where(Role::name, $role)->first();
    }
}