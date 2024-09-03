<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GaleryRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'string|nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'tags' => 'array',
            'tags.*' => 'string'
        ];
    }
}
