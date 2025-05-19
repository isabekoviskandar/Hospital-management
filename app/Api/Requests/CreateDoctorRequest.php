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
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'direction_id' => 'required|integer',
        'date_of_birth' => 'required|date',
        'address' => 'required|string',
        'gender' => 'required|string',
        'salary_type' => 'required|integer',
        'salary' => 'required|numeric',
        'profile_picture' => 'nullable|mimes:png,jpg,jpeg',
        'bio' => 'nullable|string',
    ];
}

}
