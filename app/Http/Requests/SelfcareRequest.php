<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelfcareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'tutorial' => 'required',
            'text' => 'required',
            'text2' => 'required',
            'text3' => 'max:255',
            'text4' => 'max:255',
            'text5' => 'max:255'
        ];
    }
}
