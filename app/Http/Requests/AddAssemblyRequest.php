<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAssemblyRequest extends FormRequest
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
            'name' => 'unique:assemblys,name|required|max:255',
            'faculty' => 'required',
            'department' => 'required',
            'year' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Tên hội đồng đã tồn tại trên hệ thống!!!',
            'name.required' => 'Hãy điền tên hội đồng',
            'faculty.required' => 'Hãy chọn khoa',
            'year.required' => 'Hãy chọn năm',
            'department.required' => 'Hãy chọn ngành'
        ];
    }
}
