<?php

namespace App\Domain\Actions\Doctor;

use App\Api\Requests\UpdateDoctorRequest;
use App\Api\Resources\DoctorsResource;
use App\Domain\Doctor\Model\Doctor;
use App\Domain\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class UpdateDoctor
{
    public function handle(UpdateDoctorRequest $request, $id)
    {
        $validated = $request->validated();

        Log::info('Updating doctor - ID: ' . $id, $validated);

        try {
            DB::beginTransaction();

            $doctor = Doctor::findOrFail($id);
            Log::info('Doctor found:', ['doctor_id' => $doctor->id, 'user_id' => $doctor->user_id]);

            $user = $doctor->user;
            Log::info('Associated user found:', ['user_id' => $user->id]);

            $userFields = [];
            if (isset($validated['name'])) {
                $userFields['name'] = $validated['name'];
            }
            if (isset($validated['email'])) {
                $userFields['email'] = $validated['email'];
            }
            if (isset($validated['password'])) {
                $userFields['password'] = Hash::make($validated['password']);
            }

            if (!empty($userFields)) {
                $user->update($userFields);
                Log::info('User updated successfully:', $userFields);
            }

            $imagePath = $doctor->profile_picture; 
            if (isset($validated['profile_picture']) && is_object($validated['profile_picture'])) {
                Log::info('Uploading new profile picture...');
                
                if ($doctor->profile_picture && Storage::disk('public')->exists($doctor->profile_picture)) {
                    Storage::disk('public')->delete($doctor->profile_picture);
                    Log::info('Old profile picture deleted:', ['path' => $doctor->profile_picture]);
                }
                
                $imagePath = $validated['profile_picture']->store('doctors', 'public');
                Log::info('New profile picture uploaded:', ['path' => $imagePath]);
            }

            $doctorFields = [];
            if (isset($validated['first_name'])) {
                $doctorFields['first_name'] = $validated['first_name'];
            }
            if (isset($validated['last_name'])) {
                $doctorFields['last_name'] = $validated['last_name'];
            }
            if (isset($validated['direction_id'])) {
                $doctorFields['direction_id'] = $validated['direction_id'];
            }
            if (isset($validated['date_of_birth'])) {
                $doctorFields['date_of_birth'] = $validated['date_of_birth'];
            }
            if (isset($validated['gender'])) {
                $doctorFields['gender'] = $validated['gender'];
            }
            if (isset($validated['salary_type'])) {
                $doctorFields['salary_type'] = $validated['salary_type'];
            }
            if (isset($validated['salary'])) {
                $doctorFields['salary'] = $validated['salary'];
            }
            if (isset($validated['address'])) {
                $doctorFields['address'] = $validated['address'];
            }
            if (isset($validated['bio'])) {
                $doctorFields['bio'] = $validated['bio'];
            }
            if (isset($validated['profile_picture']) && is_object($validated['profile_picture'])) {
                $doctorFields['profile_picture'] = $imagePath;
            }

            if (!empty($doctorFields)) {
                $doctor->update($doctorFields);
                Log::info('Doctor updated successfully:', $doctorFields);
            }

            $doctor->refresh();

            DB::commit();

            Log::info('Doctor update completed successfully:', ['doctor_id' => $doctor->id]);

            return new DoctorsResource($doctor);

        } catch (Exception $e) {
            DB::rollBack();
            
            Log::error('Error updating doctor:', [
                'doctor_id' => $id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'validated_data' => $validated
            ]);

            throw $e;
        }
    }
}