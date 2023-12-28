<?php

use Illuminate\Support\Facades\Route;

Route::middleware("checkInstallation")->group(function () {

    Route::get("/", [App\Http\Controllers\HomeController::class, "index"])->name("home");
    Route::post("/setlocale", [App\Http\Controllers\HomeController::class, "setLocale"])->name("locale.set");

    Route::controller(App\Http\Controllers\EducationController::class)->prefix("education")->group(function () {
        Route::get("/", "index")->name("education.index");
        Route::get("/{education}/{slug}", "show")->name("education.show");
        Route::get("/application", "application")->name("education.application");
        Route::post("/application/send", "applicationSend")->name("education.application.send");
    });

    Route::post("/newsletter", [App\Http\Controllers\NewsletterController::class, "store"])->name("newsletter.store");

    Route::get("/contact", [App\Http\Controllers\ContactController::class, "index"])->name("contact.index");
    Route::post("/contact/send", [App\Http\Controllers\ContactController::class, "send"])->name("contact.send");

    Route::get("/sitemap.xml", [App\Http\Controllers\SitemapController::class, "index"])->name("sitemap.index");

    Route::get("/page/{page}/{slug}", [App\Http\Controllers\PageController::class, "show"])->name("page.show");

    Route::get("/blog", [App\Http\Controllers\BlogController::class, "index"])->name("blog.index");
    Route::get("/blog/{post}/{slug}", [App\Http\Controllers\BlogController::class, "show"])->name("blog.show");

    Route::controller(App\Http\Controllers\ServiceController::class)->prefix("service")->group(function () {
        Route::get("/", "index")->name("service.index");
        Route::get("/{service}/{slug}", "show")->name("service.show");
        Route::get("/{category}", "category")->name("service.category");
    });

    Route::controller(App\Http\Controllers\ProjectController::class)->prefix("project")->group(function () {
        Route::get("/", "index")->name("project.index");
        Route::get("/{project}/{slug}", "show")->name("project.show");
        Route::get("/{category}", "category")->name("project.category");
    });

    Route::controller(App\Http\Controllers\ProductController::class)->prefix("product")->group(function () {
        Route::get("/", "index")->name("product.index");
        Route::get("/{product}/{slug}", "show")->name("product.show");
        Route::get("/{category}", "category")->name("product.category");
    });


    // Route::get("/reference", [App\Http\Controllers\ReferenceController::class, "index"])->name("reference.index");
});

//Route::get("/category/{category}/{slug}", [App\Http\Controllers\CategoryController::class, "show"])->name("category.show");
