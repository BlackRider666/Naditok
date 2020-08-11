<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title_ru'      =>  'required|string|max:255',
            'title_ua'      =>  'string|max:255',
            'parent_id'     =>  'int|exists:categories,id',
            'thumb'         =>  'required|image',
            'desc_ru'       =>  'nullable|string',
            'desc_ua'       =>  'nullable|string',
            'slug'          =>  'required|string|max:255|unique',
        ];
    }
}
