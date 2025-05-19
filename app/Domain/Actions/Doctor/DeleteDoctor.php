<?php

namespace App\Domain\Actions\Doctor;

use App\Domain\Doctor\Model\Doctor;

class DeleteDoctor{

    public function handle($id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->delete();

        return response()->json([
            'message' , 'Doctor deleted succesfully',
        ]);
    }
}