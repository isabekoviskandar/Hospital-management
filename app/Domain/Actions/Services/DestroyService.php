<?php

namespace App\Domain\Actions\Services;

use App\Domain\Service\Model\Service;

class DestroyService{


    public function handle($id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return response()->json([
            'message' => 'Service deleted successfully',
        ]);
    }
}