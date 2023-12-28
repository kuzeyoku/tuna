<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Language;
use App\Services\Admin\LanguageService;
use App\Http\Requests\Language\StoreLanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected $service;

    public function __construct(LanguageService $languageService)
    {
        $this->authorizeResource(Language::class);
        $this->service = $languageService;
        view()->share([
            'route' => $this->service->route(),
            'folder' => $this->service->folder()
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

    public function store(StoreLanguageRequest $request)
    {
        try {
            $this->service->create((object)$request->validated());
            LogController::logger("info", __("admin/{$this->service->folder()}.create_log", ["title" => $request->title]));
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

    public function edit(Language $language)
    {
        return view("admin.{$this->service->folder()}.edit", compact('language'));
    }

    public function files(Language $language)
    {
        $this->authorize("fileProcess", Language::class);
        $response = $this->service->files($language);
        $frontFiles = $response['frontFiles'] ?? [];
        $adminFiles = $response['adminFiles'] ?? [];
        $fileContent = $response['fileContent'] ?? [];
        $filename = $response['filename'] ?? null;
        $dir = $response['folder'] ?? null;
        return view("admin.{$this->service->folder()}.files", compact('language', 'frontFiles', 'adminFiles', 'fileContent', 'filename', 'dir'));
    }

    public function updateFileContent(Language $language, Request $request)
    {
        $this->authorize("fileProcess", Language::class);
        try {
            $this->service->updateFileContent($language);
            LogController::logger("info", __("admin/{$this->service->folder()}.update_file_content_log", ["title" => $language->title]));
            return back()->withSuccess(__("admin/{$this->service->folder()}.update_file_content_success"));
        } catch (Throwable $e) {
            LogController::logger("error", $e->getMessage());
            return back()->withError(__("admin/{$this->service->folder()}.update_file_content_error"));
        }
    }

    public function update(UpdateLanguageRequest $request, Language $language)
    {
        try {
            $this->service->update((object)$request->validated(), $language);
            LogController::logger("info", __("admin/{$this->service->folder()}.update_log", ["title" => $request->title]));
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

    public function destroy(Language $language)
    {
        try {
            $this->service->delete($language);
            LogController::logger("info", __("admin/{$this->service->folder()}.delete_log", ["title" => $language->title]));
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
