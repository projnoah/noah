<?php

namespace Noah;

use Illuminate\Http\Request;
use Storage;
use Illuminate\Http\UploadedFile;
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
     */
    const TYPE_LOCAL = 0;

    /**
     * The remote type lookup.
     */
    const TYPE_REMOTE = 1;

    /**
     * The default avatar uri.
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

    /**
     * Move the avatar file into storage.
     *
     * @param UploadedFile $file
     * @param User         $user
     * @return static
     *
     * @author Cali
     */
    public static function move(UploadedFile $file, User $user)
    {
        $path = 'avatars/' . $user->id . '/' . $file->hashName();
        Storage::put($path, file_get_contents($file->getRealPath()));

        $avatar = new static([
            'type' => 0,
            'src'  => $path
        ]);
        $user->avatars()->save($avatar);

        return $avatar;
    }

    /**
     * Resize the avatar by the given data.
     * 
     * @param Request $request
     * @return mixed
     * 
     * @author Cali
     */
    public static function resize(Request $request)
    {
        $old_avatar = $request->user()->localAvatar();
        $path = storage_path('app/' . $old_avatar->src);

        $resized_avatar = resize_avatar($path, intval($request->width), intval($request->height), intval($request->x), intval($request->y));

        $avatar = new Avatar(['type' => Avatar::TYPE_LOCAL, 'src' => $old_avatar->src]);
        $request->user()->avatars()->save($avatar);
        
        return $resized_avatar;
    }
}