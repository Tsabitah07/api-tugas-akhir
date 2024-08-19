<?php

namespace App\Http\Requests\Counseling;

use Illuminate\Foundation\Http\FormRequest;

class EditCounselingRequest extends FormRequest
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
//            'name' => 'string',
            'grade_id' => 'integer|nullable',
            'student_id' => 'integer|nullable',
            'counseling_date' => 'date|nullable',
            'time' => 'string|nullable',
            'expired' => 'boolean|nullable',
            'service' => 'string|nullable',
            'subject' => 'string|nullable',
//            'place' => 'string',
            'counseling_status_id' => 'integer'
        ];
    }
}
