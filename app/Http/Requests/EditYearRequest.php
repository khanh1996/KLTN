<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditYearRequest extends FormRequest
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
            'name' => 'unique:years,name,'.$this->segment(2).',id|numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Tên năm đã tồn tại trên hệ thống!!!',
            'name.required' => 'Hãy điền tên năm',
        ];
    }
}
