<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Page;
// use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MenuProvider extends ServiceProvider
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
        $cache = cache();
        $cacheTime = config("setting.caching.time", 3600);

        view()->composer("layout.footer", function ($view) use ($cache, $cacheTime) {

            $pages = $cache->remember("footerPages_" . app()->getLocale(), $cacheTime, function () {
                $pages = [];
                $pageList = config("setting.information");
                if (!is_null($pageList)) {
                    $pageList = array_filter($pageList, "is_numeric");
                    foreach ($pageList as $index => $page)
                        $pages[$index] = Page::find($page);
                }
                return $pages;
            });

            // $services = $cache->remember("footerServices_" . app()->getLocale(), $cacheTime, function () {
            //     $query = \App\Models\Service::active()->order()->limit(5)->get();
            //     if ($query->count() > 0)
            //         return $query;
            //     return [];
            // });

            $cookie = $cache->remember("footerCookie_" . app()->getLocale(), $cacheTime, function () {
                if (config("setting.information.cookie_policy_page"))
                    return Page::findOrFail(config("setting.information.cookie_policy_page"));
            });

            $terms = $cache->remember("footerTerms_" . app()->getLocale(), $cacheTime, function () {
                if (config("setting.information.user_agreement_page"))
                    return Page::findOrFail(config("setting.information.user_agreement_page"));
            });

            $privacy = $cache->remember("footerPrivacy_" . app()->getLocale(), $cacheTime, function () {
                if (config("setting.information.privacy_agreement_page"))
                    return Page::findOrFail(config("setting.information.privacy_agreement_page"));
            });

            $kvkk = $cache->remember("footerKvkk_" . app()->getLocale(), $cacheTime, function () {
                if (config("setting.information.kvkk_page"))
                    return Page::findOrFail(config("setting.information.kvkk_page"));
            });

            $view->with(compact("pages", "cookie", "terms", "privacy", "kvkk"));
        });

        view()->composer("layout.header", function ($view) use ($cache, $cacheTime) {
            $headerMenu = $cache->remember("headerMenu_" . app()->getLocale(), $cacheTime, function () {
                return Menu::whereType("header")->order()->get();
            });
            $view->with(compact("headerMenu"));
        });

        view()->composer("layout.topbar", function ($view) use ($cache, $cacheTime) {
            $languageList = $cache->remember("frontLanguageList", $cacheTime, function () {
                $language = new \App\Models\Language();
                return $language->active()->pluck("title", "code");
            });
            $view->with(compact("languageList"));
        });
    }
}
