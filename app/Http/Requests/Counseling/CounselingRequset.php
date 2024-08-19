<?php

namespace App\Http\Requests\Counseling;

use Illuminate\Foundation\Http\FormRequest;

class CounselingRequset extends FormRequest
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
            'grade_id' => 'required|integer',
            'student_id' => 'required|integer',
            'counseling_date' => 'required|date',
            'time' => 'required',
            'expired' => 'boolean|nullable',
            'service' => 'required|string',
            'subject' => 'required|string',
            'counseling_status_id' => 'integer|nullable'
        ];
    }
}
