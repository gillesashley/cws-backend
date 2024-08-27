<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth,
            'role' => $this->role,
            'region_id' => $this->region_id,
            'constituency_id' => $this->constituency_id,
            'constituency' => $this->whenLoaded('constituency', function () {
                return [
                    'id' => $this->constituency->id,
                    'name' => $this->constituency->name,
                ];
            }),
            'region' => $this->whenLoaded('constituency.region', function () {
                return [
                    'id' => $this->constituency->region->id,
                    'name' => $this->constituency->region->name,
                ];
            }),
            'area' => $this->area,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
