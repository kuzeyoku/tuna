<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Brand;
use App\Services\Admin\BrandService;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;

class BrandController extends Controller
{
    protected $service;

    public function __construct(BrandService $service)
    {
        $this->authorizeResource(Brand::class);
        $this->service = $service;
        view()->share([
            "route" => $this->service->route(),
            "folder" => $this->service->folder()
        ]);
    }

    public function index()
    {
        $items = $this->service->all();
        return view("admin.{$this->service->folder()}.index", compact("items"));
    }

    public function create()
    {
        return view("admin.{$this->service->folder()}.create");
    }

    public function store(StoreBrandRequest $request)
    {
        try {
            $this->service->create((object)$request->validated());
            LogController::logger("info", __("admin/{$this->service->folder()}.create_log"));
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

    public function edit(Brand $brand)
    {
        return view("admin.{$this->service->folder()}.edit", compact("brand"));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        try {
            $this->service->update((object)$request->validated(), $brand);
            LogController::logger("info", __("admin/{$this->service->folder()}.update_log"));
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

    public function destroy(Brand $brand)
    {
        try {
            $this->service->delete($brand);
            LogController::logger("info", __("admin/{$this->service->folder()}.delete_log"));
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
