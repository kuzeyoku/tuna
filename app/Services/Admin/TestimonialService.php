<?php

namespace App\Services\Admin;

use App\Models\Testimonial;
use App\Enums\ModuleEnum;
use Illuminate\Database\Eloquent\Model;
use App\Services\Admin\ImageService;
use Illuminate\Http\Request;

class TestimonialService extends BaseService
{

    protected $imageService;
    protected $testimonial;

    public function __construct(Testimonial $testimonial)
    {
        parent::__construct($testimonial, ModuleEnum::Testimonial);
        $this->imageService = new ImageService(ModuleEnum::Testimonial);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "name" => $request->name,
            "company" => $request->company,
            "position" => $request->position,
            "message" => $request->message,
            "order" => $request->order,
            "status" => $request->status,
        ]);

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
        }

        return parent::create($data);
    }

    public function update(Object $request, Model $testimonial)
    {
        $data = new Request([
            "name" => $request->name,
            "company" => $request->company,
            "position" => $request->position,
            "message" => $request->message,
            "order" => $request->order,
            "status" => $request->status
        ]);

        if (isset($request->imageDelete)) {
            parent::imageDelete($testimonial);
        }
        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
            if ($data->image && !is_null($testimonial->image))
                parent::imageDelete($testimonial);
        }
        return parent::update($data, $testimonial);
    }
}
