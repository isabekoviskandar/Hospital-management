<?php

namespace App\Domain\Actions\Doctor;

use App\Api\Requests\CreateDoctorRequest;
use App\Api\Resources\DoctorsResource;
use App\Domain\Doctor\Model\Doctor;
use App\Domain\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateDoctor
{
    public function handle(CreateDoctorRequest $request)
    {
        $validated = $request->validated();

        Log::info('Creating doctor - validated data:', $validated);

        try {
            DB::beginTransaction();

            Log::info('Starting user creation...');
            
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Log::info('User created successfully:', ['user_id' => $user->id, 'email' => $user->email]);

            $imagePath = null;
            if (isset($validated['profile_picture']) && is_object($validated['profile_picture'])) {
                Log::info('Uploading profile picture...');
                $imagePath = $validated['profile_picture']->store('doctors', 'public');
                Log::info('Profile picture uploaded:', ['path' => $imagePath]);
            }

            Log::info('Starting doctor creation...');

            $doctor = Doctor::create([
                'user_id' => $user->id,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'direction_id' => $validated['direction_id'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'salary_type' => $validated['salary_type'],
                'address' => $validated['address'] ?? null,
                'salary' => $validated['salary'],
                'profile_picture' => $imagePath ?? null,
                'bio' => $validated['bio'] ?? null,
            ]);

            Log::info('Doctor created successfully:', ['doctor_id' => $doctor->id, 'user_id' => $user->id]);

            DB::commit();

            Log::info('Doctor creation completed successfully');

            return new DoctorsResource($doctor);

        } catch (Exception $e) {
            DB::rollBack();
            
            Log::error('Error creating doctor:', [
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