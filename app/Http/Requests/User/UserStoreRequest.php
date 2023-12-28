<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed",
            "password_confirmation" => "required|min:6",
            "role" => "required",
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => __("admin/user.form.name"),
            "email" => __("admin/user.form.email"),
            "password" => __("admin/user.form.password"),
            "role" => __("admin/user.form.role"),
        ];
    }
}
