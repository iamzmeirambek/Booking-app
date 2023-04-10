<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'country_id' => $this->country_id,
            'name' => $this->name,
            'lat' => $this->lat,
            'long' => $this->long,
        ];
    }
}
