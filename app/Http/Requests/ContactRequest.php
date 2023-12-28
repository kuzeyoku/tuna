<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|min:3|max:50",
            "phone" => "required|numeric|digits_between:10,15",
            "email" => "required|email:filter",
            "subject" => "required|string|min:3|max:50",
            "message" => "required|string|min:3|max:500",
            "terms" => "required|accepted",
            "g-recaptcha-response" => "",
        ];
    }

    public function attributes()
    {
        return [
            "name" => __("front/contact.form_name"),
            "phone" => __("front/contact.form_phone"),
            "email" => __("front/contact.form_email"),
            "subject" => __("front/contact.form_subject"),
            "message" => __("front/contact.form_message"),
            "terms" => __("front/contact.form_terms"),
            "g-recaptcha-response" => __("front/contact.form_recaptcha"),
        ];
    }
}
