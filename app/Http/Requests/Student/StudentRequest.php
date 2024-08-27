<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'nis' => 'min:5|unique:students|string',
            'email' => 'email|nullable',
            'username' => 'min:5|unique:students|string|nullable',
            'name' => 'max:255',
            'role_id' => 'nullable|integer',
            'grade_id' => 'required|integer',
            'phone_number' => 'min:10|nullable',
            'birth_place' => 'string',
            'birth_date' => 'string',
            'year_of_entry' => 'string',
            'password' => 'min:8',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
