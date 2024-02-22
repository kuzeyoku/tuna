<?php

namespace App\Http\Requests\Galery;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGaleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "description.*" => "",
            "type" => "required",
            "order" => "numeric",
            "status" => "required",
            "image" => "image|mimes:png,jpeg,jpg,gif|max:" . config("setting.image.max_size", 4096),
        ];
    }

    public function attributes(): array
    {
        return [
            "title." . app()->getFallbackLocale() => __("admin/{$this->folder}.form_title"),
            "description.*" => __("admin/{$this->folder}.form_description"),
            "type" => __("admin/{$this->folder}.form_type"),
            "order" => __("admin/general.order"),
            "status" => __("admin/general.status"),
            "image" => __("admin/{$this->folder}.form_image"),
        ];
    }
}
