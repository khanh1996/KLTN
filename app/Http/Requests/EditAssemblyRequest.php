<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAssemblyRequest extends FormRequest
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
            'name' => 'unique:assemblys,name,'.$this->segment(2).'|required|max:255',
            'faculty' => 'required',
            'department' => 'required',
            'year' => 'required',
            'president' => 'required',
            'secretary' => 'required',
            'commissary' => 'required',
            'reviewer' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Tên hội đồng đã tồn tại trên hệ thống!!!',
            'name.required' => 'Hãy điền tên hội đồng',
            'faculty.required' => 'Hãy chọn khoa',
            'year.required' => 'Hãy chọn năm',
            'department.required' => 'Hãy chọn ngành',
            'president.required' => 'Hãy chọn chủ tịch',
            'commissary.required' => 'Hãy chọn ủy viên',
            'secretary.required' => 'Hãy chọn Thư ký',
            'reviewer.required' => 'Hãy chọn phản biện'
        ];
    }
}
