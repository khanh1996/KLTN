<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'code' => 'unique:users,code|required|min:6',
            /*'email' => 'exists:users|string',*/
            'name' => 'required|max:255',
            'password' => 'required|min:6|max:20',
            'role' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
    public function messages()
    {
        return [
            'code.unique' => 'Mã tài khoản đã tồn tại trên hệ thống!!!',
            'email.exists' => 'Email đã tồn tại trên hệ thống!!!',
            'email.email' => 'Hãy nhập đúng định dạng email, vd: abc@gmail.com',
            'email.string' => 'Hãy nhập đúng định dạng của Email',
            'code.min' => 'Mã tài khoản phải ít nhất 6 ký tự',
            'code.required' => 'Hãy điền mã tài khoản',
            'name.required' => 'Hãy điền tên tài khoản',
            'password.required' => 'Hãy điền mật khẩu tài khoản',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu quá dài, mật khẩu chỉ tối đa 20 ký tự',
            'role.required' => 'Hãy chọn quyền cho tài khoản',
            'image.mimes' => 'Phần mở rộng của tệp phải là các dạng :jpeg,png,jpg,gif,svg',
            'image.image' => 'Hãy tải lên file dạng ảnh'
        ];
    }
}
