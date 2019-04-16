<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            //
            'code' => 'required|min:6',
            'password' => 'required|min:6|max:20'
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Vui lòng nhập mã sinh viên hoặc giáo viên',
            'password.required' => 'Mật khẩu của bạn không đúng',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu phải không được quá 20 ký tự',
        ];
    }
}
