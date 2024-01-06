<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $modules = [
            ModuleEnum::Slider,
            ModuleEnum::Product,
            // ModuleEnum::Service,
            // ModuleEnum::Brand,
            ModuleEnum::Project,
            // ModuleEnum::Testimonial,
            ModuleEnum::Blog,
            ModuleEnum::Reference,
        ];

        $data = [];

        foreach ($modules as $module) {
            $model = $module->model();
            $data[$module->value] = Cache::remember($module->value . "_home", config("setting.caching.time", 3600), function () use ($module, $model) {
                return $model::active()->order()->limit($module->homeLimit())->get();
            })->unless(config("setting.caching.status", false), function () use ($module, $model) {
                return $model::active()->order()->limit($module->homeLimit())->get();
            });
        }

        return view("index", $data);
    }

    public function setLocale(Request $request)
    {
        $request->validate([
            "locale" => "required|exists:languages,code",
        ]);
        session()->put("locale", $request->locale);
        return redirect()->back();
    }
}
