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
            'username' => 'required|string|max:255|unique:mentors,username',
            'email' => 'email',
            'role_id' => 'integer',
            'grade_id' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'age' => 'integer',
            'gender' => 'required|string|max:255',
            'experience' => 'string',
            'last_education' => 'required|string',
            'last_university' => 'string',
            'phone_number' => 'string',
//            'user_id' => 'required|integer',
            'about_me' => 'string',
            'linkedin' => 'string',
            'instagram' => 'string',
            'twitter' => 'string',
            'facebook' => 'string',
            'image' => 'required|image',
            'password' => 'required|string|min:8'
        ];
    }
}
