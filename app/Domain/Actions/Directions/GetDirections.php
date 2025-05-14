<?php


namespace App\Domain\Actions\Directions;

use App\Api\Resources\DirectionResource;
use App\Domain\Directions\Model\Directions;

class GetDirections{

    public function handle()
    {
        $direction = Directions::all();

        return DirectionResource::collection($direction);
    }
}