<?php

use App\Enums\ModuleEnum;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::middleware("checkInstallation")->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        // Route::get("/storage-link", function () {
        //     Artisan::call("storage:link");
        //     return back()->with("success", "Storage Link Successfull");
        // })->name("storage-link");

        // Auth Routes
        Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('auth.login');
        Route::post('authenticate', [App\Http\Controllers\Admin\AuthController::class, 'authenticate'])->name('auth.authenticate');
        Route::middleware(['auth'])->group(function () {
            Route::get('logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('auth.logout');

            // Admin Dashboard Route
            Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');

            // Setting Routes
            Route::controller(App\Http\Controllers\Admin\SettingController::class)->prefix('setting')->group(function () {
                Route::get('/', 'index')->name('setting');
                Route::put('/update', 'update')->name('setting.update');
            });

            // Menu Routes
            if (ModuleEnum::Menu->status())
                Route::controller(App\Http\Controllers\Admin\MenuController::class)->prefix('menu')->group(function () {
                    Route::get('/header', 'header')->name('menu.header');
                    Route::get('/footer', 'footer')->name('menu.footer');
                });

            //Message Routes
            if (ModuleEnum::Message->status())
                Route::controller(App\Http\Controllers\Admin\MessageController::class)->prefix("message")->group(function () {
                    Route::get("/", "index")->name("message.index");
                    Route::get("/{message}/show", "show")->name("message.show");
                    Route::get("/{message}/reply", "reply")->name("message.reply");
                    Route::post("/sendReply", "sendReply")->name("message.sendReply");
                    Route::delete("/{message}/destroy", "destroy")->name("message.destroy");
                });

            // Other Routes
            Route::post('editor/upload')->uses("App\Http\Controllers\Admin\EditorController@store")->name("editor.upload");
            Route::get('cache-clear')->uses("App\Http\Controllers\Admin\HomeController@cacheClear")->name('cache-clear');
            Route::post("logclean")->uses("App\Http\Controllers\Admin\HomeController@logclean")->name("logclean");

            Route::controller(App\Http\Controllers\Admin\LanguageController::class)->prefix("language")->group(function () {
                Route::match(["get", "post"], "/{language}/files", "files")->name("language.files");
                Route::post("/{language}/getFileContent", "getFileContent")->name("language.getFileContent");
                Route::put("/{language}/updateFileContent", "updateFileContent")->name("language.updateFileContent");
            });

            if (ModuleEnum::Product->status())
                Route::controller(App\Http\Controllers\Admin\ProductController::class)->prefix("product")->group(function () {
                    // Route::get("/{project}", "show")->name("product.show");
                    Route::get("/{product}/image", "image")->name("product.image");
                    Route::post("/imageStore", "imageStore")->name("product.imageStore");
                    Route::delete("/{image}/imagedelete", "imageDelete")->name("product.imageDelete");
                    Route::delete("/{product}/imagealldelete", "imageAllDelete")->name("product.imageAllDelete");
                });

            if (ModuleEnum::Project->status())
                Route::controller(App\Http\Controllers\Admin\ProjectController::class)->prefix("project")->group(function () {
                    Route::get("/{project}/image", "image")->name("project.image");
                    Route::post("/imageStore", "imageStore")->name("project.imageStore");
                    Route::delete("/{image}/imageDelete", "imageDelete")->name("project.imageDelete");
                    Route::delete("/{project}/imageAllDelete", "imageAllDelete")->name("project.imageAllDelete");
                });

            Route::group(['prefix' => 'artisan', 'middleware' => ['web', 'auth']], function () {
                Route::get("migrate", function () {
                    Artisan::call("migrate");
                    Artisan::call("db:seed");
                    return redirect()->back()->with("success", "Migrate Successfull");
                })->name("artisan.migrate");

                Route::get("migrate_refresh", function () {
                    Artisan::call("migrate:refresh");
                    Artisan::call("db:seed");
                    return redirect()->back()->with("success", "Migrate Refresh Successfull");
                })->name("artisan.migrate_refresh");

                route::get("storage_link", function () {
                    Artisan::call("storage:link");
                    return redirect()->back()->with("success", "Storage Link Successfull");
                });
            });

            // Resource Routes
            foreach (App\Enums\ModuleEnum::cases() as $module) {
                //Route::resource($module->route(), $module->controller())->except('show')->names($module->route());
                if ($module->status())
                    Route::resource($module->route(), $module->controller())->names($module->route());
            }
        });
    });
});
