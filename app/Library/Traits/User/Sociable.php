<?php

namespace Noah\Library\Traits\User;

use Auth;
use Socialite;
use Noah\Avatar;
use Cali\Socialite\Two\User as UserData;

trait Sociable {

    /*
     |------------------------------------------------------------
     | Socializes Users
     | 用户社交化
     |------------------------------------------------------------
     |
     | 
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /**
     * Socializes the user.
     * 给用户添加社交认证
     *
     * @param  $service
     * @return static|UserData
     *
     * @author Cali
     */
    public static function socialize($service)
    {
        /** @var UserData $userData */
        $userData = Socialite::driver($service)->user();
        $info = "\"$service\":\"$userData->id\"";
        
        // If already obtained
        if (Auth::check()) {
            $user = Auth::user();
            if (self::obtained($info) === false) {
                $user->bindOAuth($service, $userData->id);
            } else {
                return false;
            }
        } else {
            $user = self::obtained($info);
        }

        return $user ?: $userData;
    }

    /**
     * Check if the user data has already obtained.
     * 检查是否已经授权过
     *
     * @param  $userData
     * @return bool|static
     *
     * @author Cali
     */
    protected static function obtained($info)
    {
        /** @var static $user */
        $user = self::where('social_info', 'like', "%$info%")
            ->first();

        return is_null($user) ? false : $user;
    }

    /**
     * Save the remote avatar.
     * 保存远程头像
     *
     * @param string $avatar
     * @return static
     * 
     * @author Cali
     */
    public function saveRemoteAvatar($avatar)
    {
        $this->avatars()->create([
            'src'  => $avatar,
            'type' => Avatar::TYPE_REMOTE
        ]);
        
        return $this;
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
        return property_exists($this->getSocialInfo(), strtolower($service));
    }

    /**
     * Bind OAuth service to the user.
     *
     * @param $service
     * @param $id
     *
     * @author Cali
     */
    public function bindOAuth($service, $id)
    {
        if (! $this->boundOAuth($service)) {
            $social = $this->getSocialInfo();
            if (is_null($social)) {
                $this->social_info = "{\"$service\":\"$id\"}";
            } else {
                $social->{$service} = (string)$id;
                $this->social_info = json_encode($social);
            }
            $this->save();
        }
    }

    /**
     * Unbind the oAuth from the user.
     *
     * @param $service
     * @author Cali
     */
    public function unbindOAuth($service)
    {
        if ($this->boundOAuth($service)) {
            $social = $this->getSocialInfo();
            unset($social->{$service});

            $this->social_info = json_encode($social);
            $this->save();
        }
    }

    /**
     * Get user's social info in json.
     *
     * @return mixed
     * @author Cali
     */
    protected function getSocialInfo()
    {
        return json_decode($this->attributes['social_info']);
    }
}