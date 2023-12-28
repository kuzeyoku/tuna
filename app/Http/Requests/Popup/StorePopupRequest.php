<?php

namespace App\Http\Requests\Popup;

use App\Enums\ModuleEnum;
use Illuminate\Foundation\Http\FormRequest;

class StorePopupRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Popup->folder();
    }

    public function rules(): array
    {
        return [
            "type" => "required",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:" . config("setting.image.max_size", 4096),
            "url" => "nullable|active_url",
            "video" => "nullable|active_url",
            "title.*" => "nullable",
            "description.*" => "nullable",
            "status" => "required",
            "time" => "numeric|nullable",
            "width" => "numeric|nullable",
            "closeOnEscape" => "required",
            "closeButton" => "required",
            "overlayClose" => "required",
            "pauseOnHover" => "required",
            "fullScreenButton" => "required",
            "color" => "nullable",
        ];
    }

    public function attributes(): array
    {
        return [
            "type" => __("admin/{$this->folder}.form.type"),
            "image" => __("admin/{$this->folder}.form.image"),
            "url" => __("admin/{$this->folder}.form.url"),
            "video" => __("admin/{$this->folder}.form.video"),
            "title.*" => __("admin/{$this->folder}.form.title"),
            "description.*" => __("admin/{$this->folder}.form.description"),
            "status" => __("admin.general.status"),
            "time" => __("admin/{$this->folder}.form.time"),
            "width" => __("admin/{$this->folder}.form.width"),
            "closeOnEscape" => __("admin/{$this->folder}.form.closeOnEscape"),
            "closeButton" => __("admin/{$this->folder}.form.closeButton"),
            "overlayClose" => __("admin/{$this->folder}.form.overlayClose"),
            "pauseOnHover" => __("admin/{$this->folder}.form.pauseOnHover"),
            "fullScreenButton" => __("admin/{$this->folder}.form.fullScreenButton"),
            "color" => __("admin/{$this->folder}.form.color"),
        ];
    }
}
