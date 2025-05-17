<?php


namespace App\Domain\Actions\Directions;

use App\Api\Requests\CreateDirectionRequest;
use App\Api\Resources\DirectionResource;
use App\Domain\Directions\Model\Direction;

class CreateDirection{


    public function handle(CreateDirectionRequest $request)
    {
        $validate = $request->validated();

        $direction = Direction::create($validate);

        return new DirectionResource($direction);
    }
}
