<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BrandService extends BaseService
{
    protected $imageService;
    protected $brand;

    public function __construct(Brand $brand)
    {
        parent::__construct($brand, ModuleEnum::Brand);
        $this->imageService = new ImageService(ModuleEnum::Brand);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "url" => $request->url,
            "title" => $request->title,
            "order" => $request->order,
            "status" => $request->status
        ]);

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
        }

        return parent::create($data);
    }

    public function update(Object $request, Model $brand)
    {
        $data = new Request([
            "url" => $request->url,
            "title" => $request->title,
            "order" => $request->order,
            "status" => $request->status
        ]);

        if (isset($request->imageDelete)) {
            parent::imageDelete($brand);
        }

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
            if ($data->image && !is_null($brand->image))
                $this->imageService->delete($brand->image);
        }

        return parent::update($data, $brand);
    }
}
