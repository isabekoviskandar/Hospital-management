<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateServiceRequest;
use App\Api\Requests\UpdateServiceRequest;
use App\Domain\Actions\Services\CreateService;
use App\Domain\Actions\Services\DestroyService;
use App\Domain\Actions\Services\GetServices;
use App\Domain\Actions\Services\UpdateService;
use Illuminate\Http\Request;

class ServiceController
{
    public function index(GetServices $getServices)
    {
        return $getServices->handle();
    }

    public function store(CreateServiceRequest $request, CreateService $createService)
    {
        return $createService->handle($request);
    }

    public function update(UpdateServiceRequest $request , UpdateService $updateService , $id)
    {
        return $updateService->handle($request , $id);
    }

    public function destroy( DestroyService $destroyService , $id)
    {
        return $destroyService->handle($id);
    }
}
