<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class createFormProduct extends FormRequest
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
            'productName'=>'required|max:255',
            'productImage'=>'required',
        ];
    }

    public function messages(): array
{
    return [
        'productName.required' => 'Product name cannot be empty',
        'productImage.required' => 'Product must have image'
    ];
}
}
