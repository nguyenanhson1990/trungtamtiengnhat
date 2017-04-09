<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAddUserRequest extends FormRequest
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
            'email' => 'required|unique:users,email|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Hãy nhập vào email',
            'password.required' => 'Hãy nhập vào password',
            'email.unique' => 'Email này đã tồn tại trong hệ thống',
            'email.email' => 'Hãy nhập đúng định dạng email',
            'first_name.required' => 'Hãy nhập họ của bạn',
            'last_name.required' => 'Hãy nhập vào tên của bạn',
            'password.required' => 'Hãy nhập vào mật khẩu của bạn'
        ];
    }
}
