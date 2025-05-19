<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the doctor ID from route parameter
        $doctorId = $this->route('id') ?? $this->route('doctor');
        
        return [
            'name' => 'nullable|string|max:255',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($this->getUserIdFromDoctor($doctorId))
            ],
            'password' => 'nullable|string|min:6',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'direction_id' => 'nullable|integer|exists:directions,id',
            'date_of_birth' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:500',
            'gender' => 'nullable|string|in:male,female,other',
            'salary_type' => 'nullable|integer',
            'salary' => 'nullable|numeric|min:0',
            'profile_picture' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'bio' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get the user ID from the doctor record for email unique validation
     */
    private function getUserIdFromDoctor($doctorId)
    {
        if (!$doctorId) {
            return null;
        }

        try {
            $doctor = \App\Domain\Doctor\Model\Doctor::find($doctorId);
            return $doctor ? $doctor->user_id : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already taken by another user.',
            'date_of_birth.before' => 'Date of birth must be before today.',
            'gender.in' => 'Gender must be either male, female, or other.',
            'profile_picture.image' => 'Profile picture must be an image file.',
            'profile_picture.max' => 'Profile picture must not exceed 2MB.',
            'direction_id.exists' => 'The selected direction does not exist.',
        ];
    }
}