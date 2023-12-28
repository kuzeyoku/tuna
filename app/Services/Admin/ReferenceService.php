<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ReferenceService extends BaseService
{
    protected $imageService;
    protected $reference;

    public function __construct(Reference $reference)
    {
        parent::__construct($reference, ModuleEnum::Reference);
        $this->imageService = new ImageService(ModuleEnum::Reference);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "url" => $request->url,
            "order" => $request->order,
            "status" => $request->status
        ]);
        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
        }

        return parent::create($data);
    }

    public function update(Object $request, Model $reference)
    {
        $data = new Request([
            "url" => $request->url,
            "order" => $request->order,
            "status" => $request->status
        ]);

        if (isset($request->imageDelete)) {
            parent::imageDelete($reference);
        }

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
            if ($data->image && !is_null($reference->image))
                $this->imageService->delete($reference->image);
        }
        return parent::update($data, $reference);
    }
}
