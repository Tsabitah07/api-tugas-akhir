<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class EditStudentRequest extends FormRequest
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
            'nis' => 'string',
            'email' => 'email|nullable',
            'username' => 'string|nullable',
            'name' => 'max:255',
            'role_id' => 'nullable|integer',
            'grade_id' => 'nullable|integer',
            'phone_number' => 'min:10|nullable',
            'birth_place' => 'string|nullable',
            'birth_date' => 'string|nullable',
            'year_of_entry' => 'string|nullable',
            'password' => 'min:8|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
