<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use App\Models\Popup;
use App\Models\PopupTranslate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PopupService extends BaseService
{
    protected $imageService;
    protected $popup;

    public function __construct(Popup $popup)
    {
        parent::__construct($popup, ModuleEnum::Popup);
        $this->imageService = new ImageService(ModuleEnum::Popup);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "type" => $request->type,
            "time" => $request->time ?? 0,
            "url" => $request->url,
            "video" => $request->video,
            "status" => $request->status,
            "width" => $request->width ?? 600,
            "closeOnEscape" => $request->closeOnEscape,
            "closeButton" => $request->closeButton,
            "overlayClose" => $request->overlayClose,
            "pauseOnHover" => $request->pauseOnHover,
            "fullScreenButton" => $request->fullScreenButton,
            "color" => $request->color ?? "#88A0B9",
        ]);

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
        }

        $query = parent::create($data);

        if ($query->id)
            $this->translations($query->id, $request);

        return $query;
    }

    public function update(Object $request, Model $popup)
    {
        $data = new Request([
            "type" => $request->type,
            "time" => $request->time ?? 0,
            "url" => $request->url,
            "video" => $request->video,
            "status" => $request->status,
            "width" => $request->width ?? 600,
            "closeOnEscape" => $request->closeOnEscape,
            "closeButton" => $request->closeButton,
            "overlayClose" => $request->overlayClose,
            "pauseOnHover" => $request->pauseOnHover,
            "fullScreenButton" => $request->fullScreenButton,
            "color" => $request->color ?? "#88A0B9",
        ]);

        if (isset($request->imageDelete)) {
            parent::imageDelete($popup);
        }

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
            if ($data->image && !is_null($popup->image))
                $this->imageService->delete($popup->image);
        }

        $query = parent::update($data, $popup);

        if ($query) {
            $this->translations($popup->id, $request);
        }
        return $query;
    }

    public function translations(int $popupId, Object $request)
    {
        $languages = languageList();
        foreach ($languages as $language) {
            PopupTranslate::updateOrCreate(
                [
                    "popup_id" => $popupId,
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
