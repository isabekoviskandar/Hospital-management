<?php


namespace App\Domain\Actions\Doctor;

use App\Api\Resources\DoctorsResource;
use App\Domain\Doctor\Model\Doctor;

class GetDoctors{

    public function handle()
    {
        $doctors = Doctor::all();

        return DoctorsResource::collection($doctors);
    }
}
