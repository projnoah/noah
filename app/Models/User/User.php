<?php

namespace Noah;

use Noah\Library\Traits\User\Sociable;
use Noah\Events\User\Auth\UserHasReset;
use Noah\Library\Traits\User\UserMetas;
use Noah\Events\User\Auth\UserHasLoggedIn;
use Noah\Library\Traits\Model\TimeSortable;
use Noah\Events\User\Auth\UserHasRegistered;
use Noah\Library\Traits\User\AvatarControls;
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

    use Sociable, TimeSortable, AvatarControls, UserMetas;

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
     * The user's avatars
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Cali
     */
    public function avatars()
    {
        return $this->hasMany(Avatar::class);
    }

    /**
     * Fetch the latest avatar.
     *
     * @return mixed
     * @author Cali
     */
    public function avatar()
    {
        return $this->avatars()->latest()->first();
    }

    /**
     * The user's roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Cali
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * The user's meta information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Cali
     */
    public function metas()
    {
        return $this->hasMany(UserMeta::class);
    }

    /*
    * Relationships ends
    */

    /**
     * Registers the user.
     *
     * @param      $attributes
     * @param null $social_info
     * @param bool $fire
     * @return static
     *
     * @event UserHasRegistered
     * @author Cali
     */
    public static function register($attributes, $social_info = null, $fire = true)
    {
        if (is_null($social_info)) {
            $user = self::create(
                self::getRegisterAttributes($attributes)
            );
        } else {
            $user = static::create($attributes);
            // Store for future authentication
            $user->social_info = $social_info;

            $user->saveRemoteAvatar($attributes['avatar'])
                ->save();
        }

        $user->assignRole();

        if ($fire) {
            event(new UserHasRegistered($user));
        }

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
     * Create an admin account.
     *
     * @param $attributes
     * @return User
     * @author Cali
     */
    public static function createAdmin($attributes)
    {
        $admin = static::register($attributes, null, false);
        $admin->assignRole('administrator');
        $admin->activated();

        return $admin;
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

        $user->activated();

        return false;
    }

    /**
     * Set the user active.
     *
     * @return $this
     * @author Cali
     */
    public function activated()
    {
        if (! $this->active) {
            $this->active = true;
            $this->save();

            return $this;
        }

        return $this;
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
        if ($this->avatars()->count() === 0) {
            return Avatar::defaultUrl();
        }

        return $this->avatar()->type === Avatar::TYPE_LOCAL ?
            route('users.avatar', ['user' => $this->id, 'v' => $this->avatarVersion()]) :
            $this->avatar()->src;
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
            return ! ! $this->roles()
                ->where($role->primaryKey, $role->id)
                ->first();
        }

        // If a string given
        return ! ! $this->roles()->where(Role::name, $role)->first();
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
        if (! array_has($attributes, 'name')) {
            $attributes = array_add($attributes, 'name', $attributes['username']);
        }
        $attributes['password'] = bcrypt($attributes['password']);

        return $attributes;
    }

    /**
     * {@inheritdoc}
     * @author Cali
     */
    public function jsonSerialize()
    {
        $attributes = $this->attributesToArray();

        return array_merge($attributes, $this->extraSerializeAttributes());
    }

    /**
     * Get the extra serialize attributes.
     *
     * @return array
     * @author Cali
     */
    protected function extraSerializeAttributes()
    {
        return [
            'avatarUrl' => $this->avatarUrl
        ];
    }

    /**
     * Assign a role to a user.
     *
     * @param int $role
     * @return $this
     * @author Cali
     */
    public function assignRole($role = Role::DEFAULT_ROLE)
    {
        if ($role instanceof Role) {
            $this->roles()->attach($role->id);
        }
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
            $this->roles()->attach($role->id);
        } else {
            $this->roles()->attach($role);
        }

        return $this;
    }

    /**
     * Helper for admin theme setting metas.
     *
     * @param        $key
     * @param string $property
     * @param bool   $default
     * @return bool
     *
     * @author Cali
     */
    public function adminThemeSettingMeta($key, $property = 'value', $default = false)
    {
        return $this->metaReader($key, $property, $default);
    }

    /**
     * Change the admin theme setting.
     *
     * @param array $attribute
     * @author Cali
     */
    public function changeAdminThemeSetting(array $attribute)
    {
        $value = json_encode([
            'type'  => $attribute['type'],
            'value' => $attribute['value']
        ]);

        $this->meta('admin.theme.' . $attribute['type'], $value);
    }

    /**
     * Change the admin theme color.
     *
     * @param array $attribute
     * @author Cali
     */
    public function changeAdminThemeColor(array $attribute)
    {
        $value = json_encode([
            'theme' => $attribute['theme'],
            'color' => $attribute['color']
        ]);

        $this->meta('admin.theme', $value);
    }

    /**
     * If the user is an admin.
     *
     * @return bool
     * @author Cali
     */
    public function isAdmin()
    {
        // TODO: Dynamic role
        return $this->hasRole('administrator');
    }
}