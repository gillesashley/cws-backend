<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignMessageResource extends JsonResource
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
            'user_id' => $this->user_id,
            'constituency_id' => $this->constituency_id,
            'title' => $this->title,
            'content' => $this->content,
            'reads' => $this->reads,
            'shareable_url' => $this->shareable_url,
            'likes_count' => $this->likes_count,
            'shares_count' => $this->shares_count,
            'user' => new UserResource($this->whenLoaded('user')),
            'constituency' => new ConstituencyResource($this->whenLoaded('constituency')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
