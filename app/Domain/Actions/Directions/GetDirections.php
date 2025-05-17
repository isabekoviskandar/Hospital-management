<?php


namespace App\Domain\Actions\Directions;

use App\Api\Resources\DirectionResource;
use App\Domain\Directions\Model\Direction;

class GetDirections{

    public function handle()
    {
        $direction = Direction::all();

        return DirectionResource::collection($direction);
    }
}