<?php

namespace Noah;

use Noah\Events\User\Auth\UserHasReset;
use Noah\Library\Traits\User\Sociable;
use Noah\Events\User\Auth\UserHasLoggedIn;
use Noah\Library\Traits\Model\TimeSortable;
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

    use Sociable, TimeSortable;

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
     * Get or set the user's meta.
     *
     * @param      $key
     * @param null $value
     * @return bool|string|object
     *
     * @author Cali
     */
    public function meta($key, $value = null)
    {
        $meta = $this->metas()->where('key', $key)->first();

        if ($value) {
            if (! $meta) {
                $meta = $this->metas()->create([
                    'key'   => $key,
                    'value' => $value
                ]);
            } else {
                $meta->value = $value;
                $meta->save();
            }
        }

        return is_null($meta) ? false : (json_decode($meta->value) ?: $meta->value);
    }

    /**
     * Helper reader method for metas.
     *
     * @param      $key
     * @param      $property
     * @param bool $default
     * @return bool
     *
     * @author Cali
     */
    public function metaReader($key, $property, $default = false)
    {
        $meta = $this->meta($key);

        if ($meta) {
            return property_exists($meta, $property) ? $meta->{$property} : $default;
        } else {
            return $default;
        }
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

    /**
     * Check if the user has bound the given oAuth service.
     * 
     * @param $service
     * @return bool
     * 
     * @author Cali
     */
    public function boundOAuth($service)
    {
        $social = json_decode($this->attributes['social_info']);
        
        return property_exists($social, strtolower($service));
    }
}