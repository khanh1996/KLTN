<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDepartmentRequest extends FormRequest
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
            'name' => 'unique:departments,name,'.$this->segment(2).',id|string|required',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Tên ngành - khoa đã tồn tại trên hệ thống!!!',
            'name.string' => 'Tên ngành  phải dạng ký tự!!!',
            'name.required' => 'Hãy điền tên ngành',
        ];
    }
}
