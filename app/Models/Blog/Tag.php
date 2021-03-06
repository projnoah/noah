<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    /*
     |------------------------------------------------------------
     | Tag Model
     | 标签 模型
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /*
     * Relationship starts
     */

    /**
     * The blogs it belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Cali
     */
    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    /*
     * Relationship ends
     */
}
