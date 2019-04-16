<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditGraduationRequest extends FormRequest
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
            'assembly' => 'required',
            'room' => 'required',
            'datetimes' => 'required',
            'report' => 'file|mimes:doc,docx,pdf|max:10485760'
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
            'assembly.required' => 'Hãy chọn hội đồng',
            'room.required' => 'Hãy điền phòng',
            'datetimes.required' => 'Hãy xác định thời gian xác nhận KLTN',
            'report.file' => 'Hãy chọn file dạng tệp tin',
            'report.mimes' => 'Phần mở rộng của tệp phải là các dạng :pdf,doc,docx',
            'report.max' => 'File báo cáo không quá 10Mb'
        ];
    }
}
