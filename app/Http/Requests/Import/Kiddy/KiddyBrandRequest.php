<?php

namespace App\Http\Requests\Import\Kiddy;

use Illuminate\Foundation\Http\FormRequest;

class KiddyBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file_brand'  =>  'required|file',
        ];
    }
}
