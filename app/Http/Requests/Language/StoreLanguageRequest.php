<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class StoreLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Language->folder();
    }

    public function rules(): array
    {
        return [
            "title" => "required",
            "code" => "required|unique:languages,code",
            "status" => "required",
        ];
    }

    public function attributes(): array
    {
        return [
            "title" => __("admin/{$this->folder}.form.title"),
            "code" => __("admin/{$this->folder}.form.code"),
            "status" => __("admin/general.status"),
        ];
    }
}
