<?php

namespace App\Http\Requests\Testimonial;

use App\Enums\ModuleEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Testimonial->folder();
    }

    public function rules(): array
    {
        return [
            // "image" => "required|image|mimes:jpeg,png,jpg,gif|max:" . config("setting.image.max_size", 4096),
            "name" => "required",
            "company" => "nullable",
            "position" => "nullable",
            "message" => "required",
            "order" => "required|numeric|min:0",
            "status" => "required",
        ];
    }

    public function attributes(): array
    {
        return [
            // "image" => __("admin/{$this->folder}.form.image"),
            "name" => __("admin/{$this->folder}.form.name"),
            "company" => __("admin/{$this->folder}.form.company"),
            "position" => __("admin/{$this->folder}.form.position"),
            "message" => __("admin/{$this->folder}.form.message"),
            "order" => __("admin/general.order"),
            "status" => "admin.general.status",
        ];
    }
}
