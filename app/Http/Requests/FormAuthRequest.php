<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email:filter',
            'password' => 'required',
            'g-recaptcha-response' => ""
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('admin/auth.email'),
            'password' => __('admin/auth.password')
        ];
    }
}
