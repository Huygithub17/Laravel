<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingAddRequest extends FormRequest
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
            'config_key' => 'required',
            'config_value' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'config_key.required' => 'Config Key không được phép để trống',
            'config_value.required' => 'Config Value không được phép để trống',
        ];
    }
}
