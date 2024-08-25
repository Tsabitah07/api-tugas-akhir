<?php

namespace App\Http\Requests\Counseling;

use Illuminate\Foundation\Http\FormRequest;

class CounselingRequest extends FormRequest
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
            'grade_id' => 'integer|nullable',
            'student_id' => 'integer|nullable',
            'counseling_date' => 'required|date',
            'time' => 'required',
            'expired' => 'boolean|nullable',
            'service' => 'required|string',
            'subject' => 'required|string',
            'place' => 'string|nullable',
            'counseling_status_id' => 'integer|nullable',
            'note' => 'string|nullable'
        ];
    }
}
