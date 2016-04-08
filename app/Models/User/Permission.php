<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    /*
     |------------------------------------------------------------
     | Permission Model
     |------------------------------------------------------------
     |
     | Permissions to be granted in order to do something
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /*
     * Relationship starts
     */

    /**
     * The roles it belongs to.
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
     * Relationship ends
     */
}
