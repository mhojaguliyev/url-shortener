<?php

namespace App\Services;

use App\Exceptions\LinkExpiredException;
use App\Models\ShortenedLink;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ShortenedLinkService
{
    /**
     * Create new shortened link
     * If exists extend expire time
     *
     * @param array $linkData
     * @return ShortenedLink
     */
    public function create(array $linkData): ShortenedLink
    {
        // constants
        $ttl = config('link.ttl', 300);
        $linkLength = config('link.length', 10);

        // fetch shortened link
        $shortenedLink = $this->getByLink($linkData['link']);

        // if link expired extend expire time
        // otherwise create new
        if (!$shortenedLink) {
            $shortenedLink = new ShortenedLink();
            $shortenedLink->link = $linkData['link'];

            while (true) {
                $shortenedLink->token = Str::random($linkLength);
                if (!$this->getByToken($shortenedLink->token)) {
                    break;
                }
            }
        }
        $shortenedLink->expired_at = Carbon::now()->addSeconds($ttl);
        $shortenedLink->save();

        // return shortened link
        return $shortenedLink;
    }

    /**
     * Get non-expired shortened link
     *
     * @throws LinkExpiredException
     */
    public function getValidByToken($token): ShortenedLink
    {
        $shortenedLink = $this->getByToken($token);

        // link not found
        if (!$shortenedLink) {
            throw new ModelNotFoundException('Invalid token', 404);
        }

        // link expired
        if ($shortenedLink->is_expired) {
            throw new LinkExpiredException('Token expired', 400);
        }

        return $shortenedLink;
    }

    /**
     * Get shortened link by token
     *
     * @param $token
     * @return ShortenedLink|null
     */
    public function getByToken($token): ?ShortenedLink
    {
        return ShortenedLink::where('token', $token)->first();
    }

    /**
     * Get shortened link by link itself
     *
     * @param $link
     * @return ShortenedLink|null
     */
    public function getByLink($link): ?ShortenedLink
    {
        return ShortenedLink::where('link', $link)->first();
    }
}
