<?php

namespace App\Domain\Actions\Directions;

use App\Api\Requests\UpdateDirectionRequest;
use App\Api\Resources\DirectionResource;
use App\Domain\Directions\Model\Direction;

class UpdateDirection
{
    public function handle(UpdateDirectionRequest $request, $id)
    {
        $validated = $request->validated();

        $direction = Direction::findOrFail($id);
        $direction->update($validated);

        return new DirectionResource($direction);
    }
}
