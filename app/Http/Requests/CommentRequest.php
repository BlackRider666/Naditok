<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'product_group_id'  =>  'required|int|exists:product_groups,id',
            'author'            =>  'required|string|max:255',
            'comment'           =>  'required|string',
            'rating'            =>  'required|numeric',
        ];
    }
}
