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
            'grade_id' => 'string|max:255',
            'birth_date' => 'date',
            'age' => 'integer',
            'gender' => 'string|max:255',
            'experience' => 'string',
            'last_education' => 'string',
            'last_university' => 'string',
            'phone_number' => 'string',
            'user_id' => 'integer',
            'about_me' => 'string',
            'linkedin' => 'string',
            'instagram' => 'string',
            'twitter' => 'string',
            'facebook' => 'string'
        ];
    }
}
