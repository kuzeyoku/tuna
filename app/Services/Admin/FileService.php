<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class fileService
{
    protected $module;

    public function __construct(ModuleEnum $module)
    {
        $this->module = $module;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = uniqid() . "." . $file->getClientOriginalExtension();
        $uploadFolder = config("setting.file.upload_folder", "file");
        $path =  "public/" . $uploadFolder . "/" . $this->module->folder();
        Storage::makeDirectory($path, 0755, true);
        return Storage::putFileAs($path, $file, $fileName) ? $fileName : null;
    }

    public function delete(string|array $file): bool
    {
        $dir = "public/" . config("setting.file.upload_folder", "file") . "/{$this->module->folder()}";
        if (is_array($file)) {
            array_map(function ($item) use ($dir) {
                if (Storage::fileExists($dir . "/" . $item)) {
                    Storage::delete($dir . "/" . $item);
                }
            }, $file);
            return true;
        }

        if (Storage::fileExists($dir . "/" . $file)) {
            return Storage::delete($dir . "/" . $file);
        }

        return false;
    }
}
