<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportUserRequest extends FormRequest
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
            'faculty' => 'required',
            'department' => 'required',
            'role' => 'required',
            'import' => 'file|mimes:xlsx,xlsm,xlsb,xls,xlam|required'
        ];
    }
    public function messages()
    {
        return [
            'faculty.required' => 'Hãy chọn khoa cho những tài khoản',
            'department.required' => 'Hãy chọn ngành cho những tài khoản',
            'role.required' => 'Hãy chọn quyền cho những tài khoản',
            'import.required' => 'Hãy tải lên file danh sách tài khoản',
            'import.file' => 'Hãy tải lên file dạng tập tin',
            'import.mimes' => 'Phần mở rộng của tệp phải là các dạng :xlsx,xlsm,xlsb,xls,xlam'
        ];
    }
}
