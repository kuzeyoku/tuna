<?php

namespace App\Services\Admin;

use App\Models\Project;
use App\Enums\ModuleEnum;
use Illuminate\Support\Str;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use App\Models\ProjectTranslate;
use Illuminate\Database\Eloquent\Model;

class ProjectService extends BaseService
{
    protected $imageService;
    protected $project;

    public function __construct(Project $project)
    {
        parent::__construct($project, ModuleEnum::Project);
        $this->imageService = new ImageService(ModuleEnum::Project);
    }

    public function create(Object $request)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "status" => $request->status,
            "category_id" => $request->category_id,
            "video" => $request->video,
            "model3D" => $request->model3D,
            "order" => $request->order
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

    public function update(Object $request, Model $project)
    {
        $data = new Request([
            "slug" => Str::slug($request->title[$this->defaultLocale]),
            "status" => $request->status,
            "category_id" => $request->category_id,
            "video" => $request->video,
            "model3D" => $request->model3D,
            "order" => $request->order
        ]);

        if (isset($request->imageDelete)) {
            parent::imageDelete($project);
        }

        if (isset($request->image) && $request->image->isValid()) {
            $data->merge(["image" => $this->imageService->upload($request->image)]);
            if ($data->image && !is_null($project->image))
                $this->imageService->delete($project->image);
        }

        $query = parent::update($data, $project);

        if ($query) {
            $this->translations($project->id, $request);
        }

        return $query;
    }

    public function translations(int $projectId, Object $request)
    {
        $languages = languageList();
        foreach ($languages as $language) {
            if (!empty($request->title[$language->code]) || !empty($request->description[$language->code])) {
                ProjectTranslate::updateOrCreate(
                    [
                        "project_id" => $projectId,
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
        dd($request->all());
        $data = new Request([
            "project_id" => $request->project_id,
            "image" => $this->imageService->upload($request->file),
        ]);

        return ProjectImage::create($data->all());
    }

    public function imageAllDelete(Model $project)
    {
        if (!$project->images->isEmpty()) {
            $this->imageService->delete($project->images->pluck("image")->toArray());
        }
        return ProjectImage::where("project_id", $project->id)->delete();
    }

    public function delete(Model $project)
    {
        $this->imageAllDelete($project);
        return parent::delete($project);
    }
}
