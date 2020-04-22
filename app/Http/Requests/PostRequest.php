<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'caption' => 'max:255|required|',
            'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    public function attributes()
    {
        return [
            'caption' => 'キャプション',
            'photo' => 'フォト',
        ];
    }
}
