<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateDoctorRequest;
use App\Api\Requests\CreateUserRequest;
use App\Domain\Actions\Doctor\CreateDoctor;
use App\Domain\Actions\Doctor\GetDoctors;

class DoctorController
{
    public function index(GetDoctors $getDoctors)
    {
        return $getDoctors->handle();
    }


    public function store(CreateDoctorRequest $request , CreateUserRequest $user_request, CreateDoctor $creator)
    {

        return $creator->handle($request , $user_request);

    }
}
