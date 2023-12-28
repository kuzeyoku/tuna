<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EditorRequest;
use claviska\SimpleImage;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new SimpleImage();
    }

    public function store(EditorRequest $request)
    {
        if ($request->hasFile("file") && $request->file("file")->isValid()) {
            $path = "public/" . config("setting.image.upload_folder", "image") . "/editor";
            $fileName = uniqid() . "." . $request->file("file")->getClientOriginalExtension();
            $this->imageManager
                ->fromFile($request->file("file")->getPathname())
                ->fitToWidth(1000)
                ->toFile($request->file("file")->getPathname());
            Storage::putFileAs($path, $request->file("file"), $fileName) ? $fileName : null;
            return ["location" => Storage::url($path . "/" . $fileName)];
        }
        return ["error" => ["message" => "File upload error"]];
    }
}
