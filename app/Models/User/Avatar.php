<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model {

    /*
     |------------------------------------------------------------
     | Avatar Model
     | 头像 模型
     |------------------------------------------------------------
     |
     | The model is responsible for storing the user's
     | avatars, the source type can be either local
     | or remote, which means no URLs are stored.
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /**
     * The local type lookup.
     *
     * @var int
     */
    const TYPE_LOCAL = 0;

    /**
     * The remote type lookup.
     *
     * @var int
     */
    const TYPE_REMOTE = 1;

    /**
     * The default avatar uri.
     *
     * @var string
     */
    const DEFAULT_URI = "assets/images/no-avatar.png";

    /**
     * Database table.
     *
     * @var string
     */
    protected $table = 'user_avatars';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'src'
    ];

    /*
     * Relationship starts
     */

    /**
     * The user it belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Cali
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
     * Relationship ends
     */

    /**
     * Get the default avatar URL.
     *
     * @return string
     *
     * @author Cali
     */
    public static function defaultUrl()
    {
        return url(static::DEFAULT_URI);
    }
}