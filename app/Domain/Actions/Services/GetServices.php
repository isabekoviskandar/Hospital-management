<?php

namespace App\Domain\Actions\Services;

use App\Api\Resources\ServicesResource;
use App\Domain\Service\Model\Service;

class GetServices{


    public function handle()
    {
        $services = Service::all();

        return ServicesResource::collection($services);
    }
}