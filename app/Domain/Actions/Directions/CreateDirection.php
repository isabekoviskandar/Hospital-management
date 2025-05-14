<?php


namespace App\Domain\Actions\Directions;

use App\Api\Requests\CreateDirectionRequest;
use App\Api\Resources\DirectionResource;
use App\Domain\Directions\Model\Directions;

class CreateDirection{


    public function handle(CreateDirectionRequest $request)
    {
        $validate = $request->validated();

        $direction = Directions::create($validate);

        return new DirectionResource($direction);
    }
}
