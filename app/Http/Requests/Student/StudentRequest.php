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
//            'user_id' => 'required|integer',
            'nis' => 'min:5|unique:students|string',
            'email' => 'email|nullable',
            'name' => 'max:255',
            'role_id' => 'required',
            'grade_id' => 'required',
            'phone_number' => 'min:10',
            'birth_place' => 'string',
            'birth_date' => 'string',
//            'id_card_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'min:8',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
