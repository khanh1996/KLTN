<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmGraduationRequest extends FormRequest
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
            'assembly' => 'required',
            'room' => 'required|max:4',
            'datetimes' => 'required',
            'report' => 'file|mimes:doc,docx,pdf|required|max:10485760',
        ];
    }
    public function messages()
    {
        return [
            'assembly.required' => 'Hãy chọn hội đồng',
            'room.required' => 'Hãy điền phòng để xác nhận bảo vệ',
            'room.max' => 'Tên phòng tối đa 4 ký tự',
            'datetimes.required' => 'Hãy chọn ngày xác nhận bảo vệ',
            'report.file' => 'Hãy chọn file dạng tệp tin',
            'report.required' => 'Hãy chọn file báo cáo KLTN',
            'report.mimes' => 'Phần mở rộng của tệp phải là các dạng :pdf,doc,docx',
            'report.max' => 'File báo cáo không quá 10Mb'
        ];
    }
}
