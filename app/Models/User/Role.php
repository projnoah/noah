<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /*
     |------------------------------------------------------------
     | Role Model
     | 权限 模型
     |------------------------------------------------------------
     |
     | One user can have multiple different roles at once and
     | each role also contains several permissions too. It
     | has a unique name and meanwhile a readable label.
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /**
     * The name attribute.
     */
    const name = "name";

    /**
     * Default role id.
     */
    const DEFAULT_ROLE = 1;

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        self::name, 'label'
    ];

    /*
     * Relationship starts
     */

    /**
     * The users associated with the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * @author Cali
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * What permissions it has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * @author Cali
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /*
     * Relationships ends
     */
}
