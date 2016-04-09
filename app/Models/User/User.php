<?php

namespace Noah;

use Noah\Events\User\Auth\UserHasReset;
use Noah\Library\Traits\User\Sociable;
use Noah\Events\User\Auth\UserHasLoggedIn;
use Noah\Events\User\Auth\UserHasRegistered;
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
     * Registers the user.
     *
     * @param $attributes
     * @return static
     *
     * @event UserWasRegistered
     * @author Cali
     */
    public static function register($attributes)
    {
        $user = self::create(
            self::getRegisterAttributes($attributes)
        );

        event(new UserHasRegistered($user));

        return $user;
    }

    /**
     * After the user has logged in.
     *
     * @event UserHasLoggedIn
     * @author Cali
     */
    public static function loggedIn()
    {
        event(new UserHasLoggedIn(auth()->user()));
    }

    /**
     * Password successfully resets.
     *
     * @return $this
     *
     * @event UserHasReset
     * @author Cali
     */
    public function passwordHasReset()
    {
        event(new UserHasReset($this));

        return $this;
    }

    /**
     * Activate the user by its email.
     *
     * @param $email
     * @return bool
     *
     * @author Cali
     */
    public static function activateByEmail($email)
    {
        $user = static::where('email', $email)->first();

        if (!$user->active) {
            $user->active = true;

            return $user->save();
        }

        return false;
    }

    /**
     * Fetch the user's avatar url.
     *
     * @return string
     *
     * @author Cali
     */
    public function getAvatarUrlAttribute()
    {
        if (is_null($this->avatar)) {
            return Avatar::defaultUrl();
        }

        return $this->avatar->type === Avatar::TYPE_LOCAL ?
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

    /**
     * Get appropriate attributes for registration.
     *
     * @param $attributes
     * @return array
     *
     * @author Cali
     */
    private static function getRegisterAttributes($attributes)
    {
        if (!array_has($attributes, 'name')) {
            $attributes = array_add($attributes, 'name', $attributes['username']);
        }
        $attributes['password'] = bcrypt($attributes['password']);

        return $attributes;
    }
}