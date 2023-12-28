<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\ProductTranslate;
use App\Models\ProductImage;
use App\Enums\ModuleEnum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ProductService extends BaseService
{
    protected $imageService;
    protected $product;

    public function __construct(Product $product)
    {
        parent::__construct($product, ModuleEnum::Product);
        $this->imageService = new ImageService(ModuleEnum::Product);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "order" => $request->order,
            "status" => $request->status,
            "category_id" => $request->category_id,
            "video" => $request->video,
        ]);

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
        }

        $query = parent::create($data);

        if ($query->id) {
            $this->translations($query->id, $request);
        }

        return $query;
    }

    public function update(Object $request, Model $product)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "order" => $request->order,
            "status" => $request->status,
            "category_id" => $request->category_id,
            "video" => $request->video,
        ]);

        if (isset($request->imageDelete)) {
            parent::imageDelete($product);
        }

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
            if ($data->image && !is_null($product->image))
                $this->imageService->delete($product->image);
        }

        $query = parent::update($data, $product);

        if ($query) {
            $this->translations($product->id, $request);
        }

        return $query;
    }

    public function translations(int $productId, Object $request)
    {
        $languages = languageList();
        foreach ($languages as $language) {
            if (!empty($request->title[$language->code]) || !empty($request->content[$language->code])) {
                ProductTranslate::updateOrCreate(
                    [
                        "product_id" => $productId,
                        "lang" => $language->code
                    ],
                    [
                        "title" => $request->title[$language->code] ?? null,
                        "description" => $request->description[$language->code] ?? null,
                        "features" => trim($request->features[$language->code]) ?? null
                    ]
                );
            }
        }
    }

    public function imageUpload(Object $request)
    {
        $data = new Request([
            "product_id" => $request->product_id,
            "image" => $this->imageService->upload($request->file),
        ]);

        return ProductImage::create($data->all());
    }

    public function imageAllDelete(Model $product)
    {
        if (!$product->images->isEmpty()) {
            $this->imageService->delete($product->images->pluck("image")->toArray());
        }
        return ProductImage::where("product_id", $product->id)->delete();
    }

    public function delete(Model $product)
    {
        $this->imageAllDelete($product);
        return parent::delete($product);
    }
}
