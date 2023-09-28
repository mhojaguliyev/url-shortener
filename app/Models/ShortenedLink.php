<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortenedLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'token',
        'expires_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    /**
     * Get the shortened full link.
     */
    protected function shortenedLink(): Attribute
    {
        return Attribute::make(
            get: fn() => config('app.url') . '/' . $this->token,
        );
    }

    /**
     * Get the shortened link's is expired attribute.
     */
    protected function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->expired_at < Carbon::now(),
        );
    }
}
