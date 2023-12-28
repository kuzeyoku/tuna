<?php

namespace App\Http\Requests\Education;

use App\Enums\ModuleEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Education->folder();
    }

    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "description.*" => "",
            "status" => "required",
            "order" => "required|numeric|min:0",
            // "category_id" => "",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:" . config("setting.image.max_size", 4096),
            "video" => "active_url|nullable",
        ];
    }

    public function attributes(): array
    {
        return [
            "title." . app()->getFallbackLocale() => __("admin/{$this->folder}.form.title"),
            "description.*" => __("admin/{$this->folder}.form.description"),
            // "category_id" => __("admin/{$this->folder}.form.category"),
            "image" => __("admin/{$this->folder}.form.image"),
            "status" => __("admin/general.status"),
            "order" => __("admin/general.order"),
            "video" => __("admin/{$this->folder}.form.video"),
        ];
    }
}
