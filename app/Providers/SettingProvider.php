<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Nothing to do here.
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $settingsConfig = Cache::remember('setting', config("setting.caching.time", 3600), function () {
            $settings = Schema::hasTable('settings') ? Setting::all() : collect([]);
            $config = [];
            $settings->each(function ($setting) use (&$config) {
                $config["setting.{$setting->category}.{$setting->key}"] = $setting->value;
            });
            return $config;
        });
        config($settingsConfig);
    }
}
