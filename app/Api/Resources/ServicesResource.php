<?php

namespace App\Api\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'direction' => $this->direction->name,
            'name' => $this->name,
            'price' => $this->price,
            'status' => $this->status,
        ];
    }
}
