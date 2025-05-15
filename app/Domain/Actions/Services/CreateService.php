<?php

namespace App\Domain\Actions\Services;

use App\Api\Requests\CreateServiceRequest;
use App\Api\Resources\ServicesResource;
use App\Domain\Service\Model\Service;

class CreateService{


    public function handle(CreateServiceRequest $request)
    {
        $validate = $request->validated();

        $service = Service::create($validate);

        return new ServicesResource($service);
    }
}