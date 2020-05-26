<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
            'year' => 'nullable|numeric|required_with:month,day',
            'month' => 'nullable|numeric',
            'day' => 'nullable|numeric'
        ];
    }
    public function attributes()
    {
        return [
            'year' => '年',
            'month' => '月',
            'day' => '日',
        ];
    }
}
