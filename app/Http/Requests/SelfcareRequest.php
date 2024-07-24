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
            'title' => 'required',
            'description' => 'string',
            'slug' => 'string|nullable',
            'text_one' => 'string',
            'text_two' => 'string',
            'text_three' => 'string|nullable',
            'text_four' => 'string|nullable',
            'text_five' => 'string|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
