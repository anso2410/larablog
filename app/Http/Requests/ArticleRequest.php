<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:20', 'unique:articles,title'],
            'content' => ['required'],
            'category' => ['sometimes', 'nullable', 'exists:categories,id'],
        ];
    }


    // public function messages()
    // {
        // return [
            // 'title.required' => 'Et le titre ?',
            // 'content.required' => 'Oublie pas le contenu',
        // ];
    // }

    public function attributes()
    {
        return [
            'title' => 'super titre',
        ];
    }
}
