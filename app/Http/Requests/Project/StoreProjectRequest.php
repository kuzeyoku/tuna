<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            "title.*" => "nullable",
            "description.*" => "nullable",
            "shortdescription.*" => "nullable",
            "features.*" => "nullable",
            "start_date" => "nullable",
            "end_date" => "nullable",
            "video" => "nullable|active_url",
            "brochure" => "nullable|mimes:pdf|max:" . config("setting.file.max_size", 4096),
            "model3D" => "nullable",
            "order" => "required|numeric|min:0",
            "status" => "required",
            "category_id" => "nullable|numeric",
            "image" => "image|mimes:png,jpeg,jpg,gif|max:" . config("setting.image.max_size", 4096),
        ];
    }

    public function attributes(): array
    {
        return [
            "title." . app()->getFallbackLocale() => __("admin/{$this->folder}.form.title"),
            "title.*" => __("admin/{$this->folder}.form.title"),
            "description.*" => __("admin/{$this->folder}.form.description"),
            "shortdescription.*" => __("admin/{$this->folder}.form.shortdescription"),
            "features.*" => __("admin/{$this->folder}.form.features"),
            "start_date" => __("admin/{$this->folder}.form.start_date"),
            "end_date" => __("admin/{$this->folder}.form.end_date"),
            "video" => __("admin/{$this->folder}.form.video"),
            "brochure" => __("admin/{$this->folder}.form.brochure"),
            "model3D" => __("admin/{$this->folder}.form.3d"),
            "order" => __("admin/general.order"),
            "status" => __("admin/general.status"),
            "category_id" => __("admin/{$this->folder}.form.category"),
            "image" => __("admin/{$this->folder}.form.image"),
        ];
    }
}
