<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'writer' => 'string|max:255|nullable',
            'category_id' => 'required|exists:article_categories,id',
            'article_content' => 'nullable|string',
            'preview_content' => 'string|nullable',
            'link' => 'url|nullable',
            'featured_image' => 'image|mimes:jpeg,png,jpg|nullable',
        ];
    }
}
