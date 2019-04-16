<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddGraduationRequest extends FormRequest
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
            'subject' => 'required',
            'teacher' => 'required',
            'student' => 'required',
            'year' => 'required',
            'semester' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'faculty.required' => 'Hãy chọn khoa',
            'year.required' => 'Hãy chọn năm',
            'department.required' => 'Hãy chọn ngành',
            'subject.required' => 'Hãy chọn đề tài',
            'teacher.required' => 'Hãy chọn giáo viên hướng dẫn',
            'student.required' => 'Hãy chọn sinh viên thực hiện',
            'semester.required' => 'Hãy chọn kỳ',
        ];
    }
}
