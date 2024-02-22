<?php

namespace App\Services\Admin;

use App\Models\Galery;
use App\Enums\ModuleEnum;
use App\Models\GaleryImage;
use App\Models\GaleryVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GaleryTranslate;
use Illuminate\Database\Eloquent\Model;

class GaleryService extends BaseService
{
    protected $imageService;
    protected $galery;

    public function __construct(Galery $galery)
    {
        parent::__construct($galery, ModuleEnum::Galery);
        $this->imageService = new ImageService(ModuleEnum::Galery);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "order" => $request->order,
            "status" => $request->status
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

    public function update(Object $request, Model $galery)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "type" => $request->type,
            "order" => $request->order,
            "status" => $request->status,
        ]);

        if (isset($request->imageDelete)) {
            parent::imageDelete($galery);
        }

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
            if ($data->image && !is_null($galery->image))
                $this->imageService->delete($galery->image);
        }

        $query = parent::update($data, $galery);

        if ($query) {
            $this->translations($galery->id, $request);
        }

        return $query;
    }

    public function translations(int $galeryId, Object $request)
    {
        $languages = languageList();
        foreach ($languages as $language) {
            if (!empty($request->title[$language->code]) || !empty($request->content[$language->code])) {
                GaleryTranslate::updateOrCreate(
                    [
                        "galery_id" => $galeryId,
                        "lang" => $language->code
                    ],
                    [
                        "title" => $request->title[$language->code] ?? null,
                        "description" => $request->description[$language->code] ?? null
                    ]
                );
            }
        }
    }

    public function imageStore(Object $request, Galery $galery)
    {
        $data = new Request([
            "galery_id" => $galery->id,
            "image" => $this->imageService->upload($request->file),
        ]);

        return GaleryImage::create($data->all());
    }


    public function imageAllDelete(Model $galery)
    {
        if (!$galery->images->isEmpty()) {
            $this->imageService->delete($galery->images->pluck("image")->toArray());
        }
        return GaleryImage::where("galery_id", $galery->id)->delete();
    }

    public function videoStore(Object $request, Galery $galery)
    {
        return GaleryVideo::create([
            "galery_id" => $galery->id,
            "video" => $request->video
        ]);
    }

    public function videoDelete(GaleryVideo $video)
    {
        return $video->delete();
    }

    public function videoAllDelete(Galery $galery)
    {
        return GaleryVideo::where("galery_id", $galery->id)->delete();
    }

    public function delete(Model $galery)
    {
        $this->imageAllDelete($galery);
        return parent::delete($galery);
    }
}
