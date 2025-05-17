<?php

namespace App\Api\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateDoctorRequest extends FormRequest
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
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'direction_id' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'salary_type' => 'required|integer',
            'salary' => 'required',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg',
            'bio' => 'nullable|string',
        ];
    }
}
