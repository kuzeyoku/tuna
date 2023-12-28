<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ImageProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "file" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:" . config("setting.image.max_size", 4096),
            "product_id" => "required|numeric"
        ];
    }
}
