<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

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
     * Blogs it belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author Cali
     */
    public function blogs()
    {
        return $this->belongsTo(Blog::class);
    }

    /*
     * Relationship ends
     */
}
