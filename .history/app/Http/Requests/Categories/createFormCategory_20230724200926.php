<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class createFormCategory extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'categoryName'=>'required|max:255'
        ];
    }

    public function messages(): array
{
    return [
        'categoryName.required' => 'The category name is not empty',
    ];
}
}
