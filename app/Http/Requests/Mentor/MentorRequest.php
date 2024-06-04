<?php

namespace App\Http\Requests\Mentor;

use Illuminate\Foundation\Http\FormRequest;

class MentorRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'grade_id' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'age' => 'integer',
            'gender' => 'required|string|max:255',
            'experience' => 'required|string',
            'last_education' => 'required|string',
            'last_university' => 'required|string',
            'phone_number' => 'required|string',
            'user_id' => 'required|integer',
            'about_me' => 'string'
        ];
    }
}
