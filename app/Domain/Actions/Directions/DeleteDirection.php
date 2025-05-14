<?php


namespace App\Domain\Actions\Directions;

use App\Domain\Directions\Model\Directions;

class DeleteDirection{


    public function handle($id)
    {
        $direction = Directions::findOrFail($id);

        $direction->delete();

        return response()->json(['message' => 'Direction deleted'], 200);

    }
}