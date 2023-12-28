<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Admin\ProductService;
use App\Http\Requests\Product\ImageProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->authorizeResource(Product::class);
        $this->service = $service;
        view()->share([
            "categories" => $this->service->getCategories(),
            "route" => $this->service->route(),
            "folder" => $this->service->folder()
        ]);
    }

    public function index()
    {
        $items = $this->service->all();
        return view("admin.{$this->service->folder()}.index", compact('items'));
    }

    public function show(Product $product)
    {
        return view("admin.{$this->service->folder()}.show", compact('product'));
    }

    public function create()
    {
        return view("admin.{$this->service->folder()}.create");
    }

    public function store(StoreProductRequest $request)
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

    public function edit(Product $product)
    {
        return view("admin.{$this->service->folder()}.edit", compact("product"));
    }

    public function image(Product $product)
    {
        return view("admin.{$this->service->folder()}.image", compact("product"));
    }

    public function imageStore(ImageProductRequest $request): object
    {
        if ($this->service->imageUpload((object)$request->validated())) {
            return (object) [
                "message" => __("admin/{$this->service->folder()}.image_success")
            ];
        } else {
            return (object) [
                "message" => __("admin/{$this->service->folder()}.image_error")
            ];
        }
    }

    public function imageDelete(ProductImage $image)
    {
        try {
            $this->service->imageDelete($image, true);
            return back()
                ->withSuccess(__("admin/{$this->service->folder()}.image_delete_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withError(__("admin/{$this->service->folder()}.image_delete_error"));
        }
    }

    public function imageAllDelete(Product $product)
    {
        try {
            $this->service->imageAllDelete($product);
            return back()
                ->withSuccess(__("admin/{$this->service->folder()}.image_delete_all_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withError(__("admin/{$this->service->folder()}.image_delete_error"));
        }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->service->update((object)$request->validated(), $product);
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

    public function destroy(Product $product)
    {
        try {
            $this->service->delete($product);
            LogController::logger("info", __("admin/{$this->service->folder()}.delete_log", ["title" => $product->title[app()->getLocale()]]));
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
