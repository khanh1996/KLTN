<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddYearRequest extends FormRequest
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
            'name' => 'unique:years,name|required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Tên Năm đã tồn tại trên hệ thống!!!',
            'name.required' => 'Hãy nhập năm'
        ];
    }
}
