<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "url" => "nullable",
            "type" => "required|in:header,footer",
            "parent_id" => "numeric|min:0|nullable",
            "order" => "required|numeric|min:0",
            "blank" => "nullable|boolean",
        ];
    }

    public function attributes(): array
    {
        return [
            "title." . app()->getFallbackLocale() => __("admin/{$this->folder}.form.title"),
            "title.*" => __("admin/{$this->folder}.form.title"),
            "url" => __("admin/{$this->folder}.form.url"),
            "type" => __("admin/{$this->folder}.form.type"),
            "parent_id" => __("admin/{$this->folder}.form.parent"),
            "order" => __("admin/general.order"),
            "blank" => __("admin/{$this->folder}.form.blank"),
        ];
    }
}
