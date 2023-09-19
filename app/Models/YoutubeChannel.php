<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Support\UuidScopeTrait;

/**
 * Class Youtube Channels.
 */

class YoutubeChannel extends Model {
    use HasFactory, UuidScopeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id',
        'channel_name',
        'channel_description',
        'channel_profile_picture',
        'uuid', // assuming uuid is also a column in your schema
    ];

    public static function create(array $attributes = [])
    {
        $model = static::query()->create($attributes);
        return $model;
    }

    public function videos()
    {
        return $this->hasMany(YoutubeChannelVideo::class);
    }

}
