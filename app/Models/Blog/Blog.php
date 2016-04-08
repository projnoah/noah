<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

    /*
     |------------------------------------------------------------
     | Blog Model
     | 博文 模型
     |------------------------------------------------------------
     |
     |
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
     * Its comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Cali
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Its tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Cali
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    /*
     * Relationship ends
     */
}
