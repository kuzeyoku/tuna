<?php

namespace App\Services\Admin;

use App\Models\Setting;
use App\Enums\ModuleEnum;
// use App\Enums\SettingCategoryEnum;
// use claviska\SimpleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Storage;

class SettingService
{
    public function route(): string
    {
        return "setting";
    }

    public function folder(): string
    {
        return "setting";
    }

    public function update(Request $request)
    {

        $settings = collect($request->except(["_token", "_method", "category"]))
            ->map(function ($value, $key) use ($request) {
                return [
                    'category' => $request->category,
                    'key' => $key,
                    'value' => $value
                ];
            })->toArray();

        if (Setting::upsert($settings, ['key', 'category'], ['value'])) {
            Cache::forget("setting");
            return true;
        } else {
            return false;
        }
    }

    public static function getSitemapModuleList()
    {
        $response = ["home"];
        if (ModuleEnum::Page->status()) array_push($response, "static_pages");
        if (ModuleEnum::Blog->status()) array_push($response, "blog", "blog_category", "blog_post");
        if (ModuleEnum::Service->status()) array_push($response, "service", "service_category", "service_detail");
        if (ModuleEnum::Product->status()) array_push($response, "product", "product_category", "product_detail");
        if (ModuleEnum::Project->status()) array_push($response, "project", "project_category", "project_detail");
        if (ModuleEnum::Education->status()) array_push($response, "education", "education_category", "education_detail");
        return $response;
    }

    public static function getChangeFreqList(): array
    {
        return [
            "always" => __("admin/setting.sitemap_changefreq_always"),
            "hourly" => __("admin/setting.sitemap_changefreq_hourly"),
            "daily" => __("admin/setting.sitemap_changefreq_daily"),
            "weekly" => __("admin/setting.sitemap_changefreq_weekly"),
            "monthly" => __("admin/setting.sitemap_changefreq_monthly"),
            "yearly" => __("admin/setting.sitemap_changefreq_yearly"),
            "never" => __("admin/setting.sitemap_changefreq_never"),
        ];
    }
}
