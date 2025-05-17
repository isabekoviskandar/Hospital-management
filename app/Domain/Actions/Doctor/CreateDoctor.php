<?php

namespace App\Domain\Actions\Doctor;

use App\Api\Requests\CreateDoctorRequest;
use App\Api\Requests\CreateUserRequest;
use App\Api\Resources\DoctorsResource;
use App\Domain\Doctor\Model\Doctor;
use App\Domain\User\User;
use Illuminate\Support\Facades\Hash;

class CreateDoctor
{
    public function handle(CreateDoctorRequest $request , CreateUserRequest $user_request)
    {
        $user = User::create($user_request->validated());

        $doctor = Doctor::create($request->validated());

        return DoctorsResource::collection($user , $doctor);
    }
}
