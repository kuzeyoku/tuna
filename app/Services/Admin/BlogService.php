<?php

namespace App\Services\Admin;

use App\Models\Blog;
use App\Models\BlogTranslate;
use App\Enums\ModuleEnum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BlogService extends BaseService
{
    protected $imageService;
    protected $blog;

    public function __construct(Blog $blog)
    {
        parent::__construct($blog, ModuleEnum::Blog);
        $this->imageService = new ImageService(ModuleEnum::Blog);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "order" => $request->order,
            "status" => $request->status,
            "category_id" => $request->category_id,
            "user_id" => auth()->user()->id
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

    public function update(Object $request, Model $post)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "order" => $request->order,
            "status" => $request->status,
            "category_id" => $request->category_id,
        ]);

        if (isset($request->imageDelete)) {
            parent::imageDelete($post);
        }

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
            if ($data->image && !is_null($post->image)) {
                $this->imageService->delete($post->image);
            }
        }

        $query = parent::update($data, $post);

        if ($query) {
            $this->translations($post->id, $request);
        }

        return $query;
    }

    public function translations(int $pageId, Object $request)
    {
        $languages = languageList();
        foreach ($languages as $language) {
            if (!empty($request->title[$language->code]) || !empty($request->content[$language->code])) {
                BlogTranslate::updateOrCreate(
                    [
                        "post_id" => $pageId,
                        "lang" => $language->code
                    ],
                    [
                        "title" => $request->title[$language->code] ?? null,
                        "description" => $request->description[$language->code] ?? null,
                        "tags" => $request->tags[$language->code] ?? null,
                    ]
                );
            }
        }
    }
}
