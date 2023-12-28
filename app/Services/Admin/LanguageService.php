<?php

namespace App\Services\Admin;

use App\Models\Language;
use App\Enums\ModuleEnum;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LanguageService extends BaseService
{
    protected $language;

    public function __construct(Language $language)
    {
        parent::__construct($language, ModuleEnum::Language);
    }

    public function create(Object $request)
    {
        $code = strtolower($request->code);
        $from = resource_path("lang/" . $this->defaultLocale);
        $to = resource_path("lang/{$code}");
        if (!File::exists($to))
            File::copyDirectory($from, $to);
        else
            throw new Exception(__("admin/language.code_exists"));
        $data = new Request([
            'title' => $request->title,
            'code' => $code,
            'status' => $request->status,
        ]);
        return parent::create($data);
    }

    public function update(Object $request, Model $language)
    {
        $data = new Request([
            'title' => $request->title,
            'status' => $request->status,
        ]);
        return parent::update($data, $language);
    }

    public function delete(Model $language)
    {
        $code = $language->code;
        if ($code == $this->defaultLocale)
            throw new Exception(__("admin/language.default_delete_error"));
        $from = resource_path("lang/{$code}");
        if (File::exists($from))
            File::deleteDirectory($from);
        return parent::delete($language);
    }

    static function toArray()
    {
        return cache()->remember('languages', config("setting.cache.caching_time", 3600), function () {
            return Language::active()->get();
        });
    }

    public function files(Language $language)
    {
        $langDisk = Storage::disk("lang");

        $extractFileData = function ($file) {
            return [strtolower(basename($file, ".php")) => ucfirst(basename($file, ".php"))];
        };
        $getFiles = function ($folder) use ($langDisk, $extractFileData, $language) {
            return array_reduce($langDisk->files("{$language->code}/{$folder}"), function ($carry, $file) use ($extractFileData) {
                return array_merge($carry, $extractFileData($file));
            }, []);
        };

        $frontFiles = $getFiles("front");
        $adminFiles = $getFiles("admin");

        if (request()->isMethod("POST")) {
            $filename = request("filename");
            $folder = request("folder");
            $fileContent = [];

            if (Lang::has($folder . "/" . $filename)) {
                Lang::setLocale($language->code);
                $fileContent = Lang::get($folder . "/" . $filename);
            }
            return compact('frontFiles', 'adminFiles', 'fileContent', 'filename', 'folder');
        }

        return compact('frontFiles', 'adminFiles');
    }

    public function updateFileContent(Language $language)
    {
        $folder = request()->folder;
        $filename = request()->filename;
        $request = request()->except("_token", "_method", "filename", "folder");
        $content = "<?php\nreturn [\n" . implode(",\n", array_map(function ($key, $value) {
            if (!is_null($key) && !is_null($value)) {
                return "'{$key}' => '" . addslashes($value) . "'";
            }
        }, array_keys($request), $request)) . "\n];";
        return Storage::disk("lang")->put($language->code . "/" . $folder . "/" . $filename . ".php", $content);
    }
}
