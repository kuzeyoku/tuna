<?php

namespace App\Http\Requests\Galery;

use Illuminate\Foundation\Http\FormRequest;

class ImageGaleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "file" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:" . config("setting.image.max_size", 4096),
        ];
    }
}
