<?php

namespace App\Http\Requests\Mentor;

use Illuminate\Foundation\Http\FormRequest;

class EditMentorRequest extends FormRequest
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
            'name' => 'string|max:255',
            'username' => 'string|max:255',
            'email' => 'email',
            'role_id' => 'integer',
            'grade_id' => 'integer',
            'birth_place' => 'string|max:255',
            'birth_date' => 'date',
            'age' => 'integer|nullable',
            'gender' => 'string|max:255',
            'experience' => 'string',
            'last_education' => 'string',
            'last_university' => 'string',
            'phone_number' => 'string',
//            'user_id' => 'integer',
            'about_me' => 'string',
            'linkedin' => 'string',
            'instagram' => 'string',
            'twitter' => 'string',
            'facebook' => 'string',
            'image' => 'image',
            'password' => 'string|min:8'
        ];
    }
}
