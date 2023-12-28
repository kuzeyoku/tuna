<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $defaultLocale;
    protected $model;
    protected $module;
    protected $cacheStatus;
    protected $cacheTime;

    public function __construct(Model $model, ModuleEnum $module = null)
    {
        $this->defaultLocale = app()->getFallbackLocale();
        $this->model = $model;
        $this->module = $module;
        $this->cacheStatus = config("setting.caching.status", false);
        $this->cacheTime = config("setting.caching.time", 3600);
    }

    public function folder()
    {
        return $this->module->folder();
    }

    public function route()
    {
        return $this->module->route();
    }

    public function all()
    {

        if ($this->cacheStatus) {
            $currentpage = Paginator::resolveCurrentPage() ?: 1;
            return Cache::remember($this->module->value . '_' . $currentpage, $this->cacheTime, function () {
                return $this->model->orderByDesc("id")->paginate(config("setting.dashboard.pagination", 15));
            });
        } else {
            return $this->model->orderByDesc("id")->paginate(config("setting.dashboard.pagination", 15));
        }
    }

    public function create(Request $request)
    {
        $this->cacheClear();
        return $this->model->create($request->all());
    }

    public function update(Request $request, Model $item)
    {
        $this->cacheClear();
        return $item->update($request->all());
    }

    public function delete(Model $item)
    {
        if (isset($item->image) && $item->image !== null) {
            $imageService = new ImageService($this->module);
            $imageService->delete($item->image);
        }
        if (isset($item->brochure) && $item->brochure !== null) {
            $fileService = new FileService($this->module);
            $fileService->delete($item->brochure);
        }
        if (isset($item->thumbnail) && $item->thumbnail !== null) {
            $imageService = new ImageService($this->module);
            $imageService->delete($item->thumbnail);
        }

        $this->cacheClear();
        return $item->delete();
    }

    public function imageDelete(Model $item, $delete = false)
    {
        if (!empty($item->image)) {
            $imageService = new ImageService($this->module);
            if ($imageService->delete($item->image)) {
                if ($delete === true)
                    return $item->delete();
                $item->image = null;
                return $item->save();
            }
            return false;
        }
        return false;
    }

    public function getCategories()
    {
        if ($this->cacheStatus) {
            $cacheKey = ($this->module ? $this->module->value . "_" : "all_") . "categories";
            return Cache::remember($cacheKey, config("setting.cache.time", 3600), function () {
                $categories = Category::whereStatus(StatusEnum::Active->value)
                    ->when($this->module !== null, function ($query) {
                        return $query->where("module", $this->module);
                    })
                    ->get();
                $response = [__("admin/general.select")];
                $titles = $categories->pluck("title." . $this->defaultLocale, "id");
                return $response + $titles->toArray();
            });
        } else {
            $categories = Category::whereStatus(StatusEnum::Active->value)
                ->when($this->module !== null, function ($query) {
                    return $query->where("module", $this->module);
                })
                ->get();
            $response = [__("admin/general.select")];
            $titles = $categories->pluck("title." . $this->defaultLocale, "id");
            return $response + $titles->toArray();
        }
    }

    public function cacheClear()
    {
        $currentpage = Paginator::resolveCurrentPage() ?: 1;
        for ($i = 1; $i <= $currentpage; $i++) {
            if (Cache::has($this->module->value . '_' . $i)) {
                Cache::forget($this->module->value . '_' . $i);
            }
        }
        if (Cache::has(($this->module ? $this->module->value . "_" : "all_") . "categories")) {
            Cache::forget(($this->module ? $this->module->value . "_" : "all_") . "categories");
        }
    }
}
