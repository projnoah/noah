<?php

namespace Noah\Library\Traits\User;

use Noah\Avatar;

trait AvatarControls {

    /**
     * Fetch the latest local avatar.
     *
     * @return mixed
     * @author Cali
     */
    public function localAvatar()
    {
        return $this->avatars()->latest()->where('type', Avatar::TYPE_LOCAL)->first();
    }

    /**
     * Get the current avatar version number.
     *
     * @return int
     * @author Cali
     */
    public function avatarVersion()
    {
        return $this->avatars()->where('type', Avatar::TYPE_LOCAL)->count();
    }

    /**
     * Get versioned avatar.
     *
     * @param $ver
     * @return mixed
     * @author Cali
     */
    public function avatarWithVersion($ver)
    {
        return $this->avatars()->where('type', Avatar::TYPE_LOCAL)
            ->skip(abs($ver - 1))->take(1)->first() ?: $this->localAvatar();
    }
}