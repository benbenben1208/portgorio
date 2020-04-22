<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:16',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'profile_photo' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'お名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'profile_photo' => 'プロフィール写真',
        ];
    }
}
