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
            'grade_id' => 'integer',
            'student_id' => 'integer',
            'counseling_date' => 'date',
            'service' => 'string',
            'subject' => 'string',
            'counseling_status_id' => 'integer'
        ];
    }
}
