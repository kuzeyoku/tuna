<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Galery;
use App\Models\GaleryImage;
use App\Http\Controllers\Controller;
use App\Services\Admin\GaleryService;
use App\Http\Requests\Galery\ImageGaleryRequest;
use App\Http\Requests\Galery\StoreGaleryRequest;
use App\Http\Requests\Galery\VideoGaleryRequest;
use App\Http\Requests\Galery\UpdateGaleryRequest;
use App\Models\GaleryVideo;

class GaleryController extends Controller
{

    protected $service;

    public function __construct(GaleryService $service)
    {
        $this->authorizeResource(Galery::class);
        $this->service = $service;
        view()->share([
            "route" => $this->service->route(),
            "folder" => $this->service->folder()
        ]);
    }

    public function index()
    {
        $items = $this->service->all();
        return view("admin/{$this->service->folder()}.index", compact("items"));
    }

    public function create()
    {
        return view("admin/{$this->service->folder()}.create");
    }

    public function store(StoreGaleryRequest $request)
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

    public function edit(Galery $galery)
    {
        return view("admin/{$this->service->folder()}.edit", compact("galery"));
    }

    public function image(Galery $galery)
    {
        return view("admin.{$this->service->folder()}.image", compact("galery"));
    }

    public function imageStore(ImageGaleryRequest $request, Galery $galery): object
    {
        if ($this->service->imageStore((object)$request->validated(), $galery)) {
            return (object) [
                "message" => __("admin/{$this->service->folder()}.image_success")
            ];
        } else {
            return (object) [
                "message" => __("admin/{$this->service->folder()}.image_error")
            ];
        }
    }

    public function imageDelete(GaleryImage $image)
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

    public function imageAllDelete(Galery $galery)
    {
        try {
            $this->service->imageAllDelete($galery);
            return back()
                ->withSuccess(__("admin/{$this->service->folder()}.image_delete_all_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withError(__("admin/{$this->service->folder()}.image_delete_error"));
        }
    }

    public function video(Galery $galery)
    {
        return view("admin.{$this->service->folder()}.video", compact("galery"));
    }

    public function videoStore(VideoGaleryRequest $request, Galery $galery)
    {
        try {
            $this->service->videoStore((object)$request->validated(), $galery);
            return redirect()
                ->back()
                ->withSuccess(__("admin/{$this->service->folder()}.video_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage);
            return back()
                ->withInput()
                ->withErrors(__("admin/{$this->service->folder()}.video_error"));
        }
    }

    public function videoDelete(GaleryVideo $video)
    {
        try {
            $this->service->videoDelete($video);
            return back()
                ->withSuccess(__("admin/{$this->service->folder()}.video_delete_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withError(__("admin/{$this->service->folder()}.video_delete_error"));
        }
    }

    public function videoAllDelete(Galery $galery)
    {
        try {
            $this->service->videoAllDelete($galery);
            return back()
                ->withSuccess(__("admin/{$this->service->folder()}.video_delete_all_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withError(__("admin/{$this->service->folder()}.video_delete_error"));
        }
    }


    public function update(UpdateGaleryRequest $request, Galery $galery)
    {
        try {
            $this->service->update((object)$request->validated(), $galery);
            LogController::logger("info", __("admin/{$this->service->folder()}.update_log", ["title" => $request->title[app()->getLocale()]]));
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/{$this->service->folder()}.update_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(__("admin/{$this->service->folder()}.update_error"));
        }
    }

    public function destroy(Galery $galery)
    {
        try {
            $this->service->delete($galery);
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
