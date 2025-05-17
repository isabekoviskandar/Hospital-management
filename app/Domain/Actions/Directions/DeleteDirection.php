<?php


namespace App\Domain\Actions\Directions;

use App\Domain\Directions\Model\Direction;

class DeleteDirection{


    public function handle($id)
    {
        $direction = Direction::findOrFail($id);

        $direction->delete();

        return response()->json(['message' => 'Direction deleted'], 200);

    }
}