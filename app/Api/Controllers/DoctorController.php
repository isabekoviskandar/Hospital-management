<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateDoctorRequest;
use App\Api\Requests\UpdateDoctorRequest;
use App\Domain\Actions\Doctor\CreateDoctor;
use App\Domain\Actions\Doctor\DeleteDoctor;
use App\Domain\Actions\Doctor\GetDoctors;
use App\Domain\Actions\Doctor\UpdateDoctor;

class DoctorController
{
    public function index(GetDoctors $getDoctors)
    {
        return $getDoctors->handle();
    }

    public function store(CreateDoctorRequest $request, CreateDoctor $creator)
    {
        return $creator->handle($request);
    }

    public function update(UpdateDoctorRequest $request ,UpdateDoctor $update, $id)
    {
        return $update->handle($request , $id);
    }

    public function destroy(DeleteDoctor $delete,  $id)
    {
        return $delete->handle($id);
    }
}
