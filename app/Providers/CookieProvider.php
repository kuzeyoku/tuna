<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CookieProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (config("setting.information.cookie_policy_page") != null) {
            $page = \App\Models\Page::find(config("setting.information.cookie_policy_page"));
            view()->composer("cookie", function ($view) use ($page) {
                $cookiePolicyPageLink = $page->getUrl();
                $view->with(compact("cookiePolicyPageLink"));
            });
        }
    }
}
