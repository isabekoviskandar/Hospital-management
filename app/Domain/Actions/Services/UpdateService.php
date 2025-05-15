<?php


namespace App\Domain\Actions\Services;

use App\Api\Requests\UpdateServiceRequest;
use App\Api\Resources\ServicesResource;
use App\Domain\Service\Model\Service;

class UpdateService
{

    public function handle(UpdateServiceRequest $request, $id)
    {

        $validated = $request->validated();

        $service = Service::findOrFail($id);

        $service->update($validated);

        return new ServicesResource($service);
    }
}
