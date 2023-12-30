<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
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
            "email" => "required|email|unique:newsletters,email",
            "terms" => "required",
            "g-recapcha-response" => ""
        ];
    }

    public function attributes(): array
    {
        return [
            "email" => __("front/contact.form_email"),
            "terms" => __("front/contact.form_terms"),
            "g-recapcha-response" => __("front/contact.form_recaptcha")
        ];
    }
}
