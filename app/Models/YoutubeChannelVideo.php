<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Support\UuidScopeTrait;
/**
 * Class Youtube Channels.
 */

class YoutubeChannelVideo extends Model {
    use HasFactory, UuidScopeTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'link',
        'title',
        'description',
        'thumbnail',
        'youtube_channel_id',
    ];

    public static function create(array $attributes = [])
    {
        // if (array_key_exists('password', $attributes)) {
        //     $attributes['password'] = Hash::make($attributes['password']);
        // }

        $model = static::query()->create($attributes);

        return $model;
    }

    public function channel()
    {
        return $this->belongsTo(YoutubeChannel::class, 'youtube_channel_id');
    }

}