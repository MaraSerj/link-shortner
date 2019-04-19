<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrackRedirect extends Model
{
    protected $fillable = [
        'short_url_id',
        'user_agent',
        'ip',
        'referer',
    ];

    /**
     * @return BelongsTo
     */
    public function shortUrl()
    : BelongsTo
    {
        return $this->belongsTo(ShortUrl::class);
    }
}
