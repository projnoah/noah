<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model {

    /*
     |------------------------------------------------------------
     | Avatar Model
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
}