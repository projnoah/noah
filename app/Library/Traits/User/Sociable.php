<?php

namespace Noah\Library\Traits\User;

use Socialite;
use Laravel\Socialite\Two\User as UserData;

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
     * @return static
     *
     * @author Cali
     */
    public static function socialize($service)
    {
        /** @var UserData $userData */
        $userData = Socialite::driver($service)->user();
        // If already obtained
        $user = self::obtained($userData);

        if (!$user instanceof static) {
            // If not, persist it
            $user = static::persist($userData);
        }

        return $user;
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
    protected static function obtained(UserData $userData)
    {
        /** @var static $user */
        $user = self::where('name', $userData->name)
            ->orWhere('username', $userData->name)
            ->orWhere('email', $userData->email)
            ->first();

        return is_null($user) ? false : $user;
    }

    /**
     * Persist data into database.
     * 保存数据到数据库
     *
     * @param  $userData
     * @return static
     *
     * @author Cali
     */
    protected static function persist(UserData $userData)
    {
        $user = static::create([
            'name'     => $userData->nickname,
            'username' => $userData->nickname,
            'email'    => $userData->email
        ]);
        $user->saveAvatar($userData->avatar);

        return $user;
    }

    /**
     * Save the remote avatar.
     * 保存远程头像
     *
     * @param string $avatar
     *
     * @author Cali
     */
    protected function saveAvatar($avatar)
    {
        $this->avatar()->create([
            'src'  => $avatar,
            'type' => 1
        ]);
    }
}