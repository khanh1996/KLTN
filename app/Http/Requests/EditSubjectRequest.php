<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSubjectRequest extends FormRequest
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
            'name' => 'unique:subjects,name,'.$this->segment(2).'|required|max:255',
            'evaluate' => 'required|max:255',
            'faculty' => 'required|max:255',
            'department' => 'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Tên Đề tài đã tồn tại trên hệ thống!!!',
            'name.required' => 'Hãy điền tên đề tài',
            'evaluate.required' => 'Hãy chọn độ khó của đề tài',
            'faculty.required' => 'Hãy chọn khoa cho đề tài',
            'department.required' => 'Hãy chọn ngành cho đề tài'
        ];
    }
}
