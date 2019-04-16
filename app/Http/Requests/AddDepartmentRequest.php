<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDepartmentRequest extends FormRequest
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
            'department' => 'unique:departments,name|required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'department.unique' => 'Tên ngành - khoa đã tồn tại trên hệ thống!!!',
            'department.required' => 'Hãy điền tên ngành - khoa'
        ];
    }
}
