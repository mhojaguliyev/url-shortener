<?php

namespace App\Http\Resources;

use App\Models\ShortenedLink;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ShortenedLink
 */
class ShortenedLinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'link' => $this->link,
            'token' => $this->token,
            'shortenedLink' => $this->shortened_link ?: null,
            'expiredAt' => $this->expired_at?->toAtomString(),
            'createdAt' => $this->created_at?->toAtomString(),
            'updatedAt' => $this->updated_at?->toAtomString(),
        ];
    }
}
