<?php

namespace App\Http\Requests\Menu;

use App\Enums\ModuleEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Menu->folder();
    }

    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "url" => "nullable",
            "urlSelect" => "nullable",
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
            "type" => __("admin/{$this->folder}.form.type"),
            "parent_id" => __("admin/{$this->folder}.form.parent"),
            "order" => __("admin/general.order"),
            "blank" => __("admin/{$this->folder}.form.blank"),
        ];
    }
}
