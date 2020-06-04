<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductGroupUpdateRequest extends FormRequest
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
            'title'         =>  'required|string|max:255',
            'brand_id'      =>  'required|int|exists:brands,id',
            'category_id'   =>  'required|int|exists:categories,id',
            'desc'          =>  'required|string',
            'weight'        =>  'integer',
            'length'        =>  'integer',
            'width'         =>  'integer',
            'height'        =>  'integer',
        ];
    }
}
