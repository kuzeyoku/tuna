<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Category;
use App\Enums\ModuleEnum;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    protected $service;
    protected $modules;

    public function __construct(CategoryService $service)
    {
        $this->authorizeResource(Category::class);
        $this->service = $service;
        $this->modules = ModuleEnum::toSelectArray();
        view()->share([
            "categories" => $this->service->getCategories(),
            "modules" => $this->modules,
            "route" => $this->service->route(),
            "folder" => $this->service->folder()
        ]);
    }

    public function index()
    {
        $items = $this->service->all();
        return view("admin.{$this->service->folder()}.index", compact('items'));
    }

    public function create()
    {
        return view("admin.{$this->service->folder()}.create");
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $this->service->create((object)$request->validated());
            LogController::logger("info", __("admin/{$this->service->folder()}.create_log", ["title" => $request->title[app()->getLocale()]]));
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/{$this->service->folder()}.create_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withInput()
                ->withError(__("admin/{$this->service->folder()}.create_error"));
        }
    }

    public function edit(Category $category)
    {
        return view("admin.{$this->service->folder()}.edit", compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $this->service->update((object)$request->validated(), $category);
            LogController::logger("info", __("admin/{$this->service->folder()}.update_log", ["title" => $request->title[app()->getLocale()]]));
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/{$this->service->folder()}.update_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withInput()
                ->withError(__("admin/{$this->service->folder()}.update_error"));
        }
    }

    public function destroy(Category $category)
    {
        try {
            $this->service->delete($category);
            LogController::logger("info", __("admin/{$this->service->folder()}.delete_log", ["title" => $category->title[app()->getLocale()]]));
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/{$this->service->folder()}.delete_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withError(__("admin/{$this->service->folder()}.delete_error"));
        }
    }
}
