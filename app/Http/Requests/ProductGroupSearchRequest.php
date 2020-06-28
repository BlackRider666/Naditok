<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductGroupSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'text'  =>  'string|max:255',
            'categoryId'    =>  'int|exists:categories,id',
            'discount'      =>  'int',
            'discount_id'   =>  'int|exists:discounts,id',
            'orderBy'       =>  'string',
        ];
    }
}
