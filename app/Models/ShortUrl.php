<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShortUrl extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
        'link',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function trackRedirects()
    : HasMany
    {
        return $this->hasMany(TrackRedirect::class);
    }
}
