<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Enums\ModuleEnum;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    protected $cacheTime;
    protected $folder;

    public function __construct()
    {
        $this->cacheTime = config("settings.caching.time", 3600);
        $this->folder = ModuleEnum::Blog->folder();
    }
    public function index()
    {

        $currentpage = Paginator::resolveCurrentPage() ?: 1;
        $pagination = config("setting.pagination.front", 10);

        $cacheKey = ModuleEnum::Blog->value . "_" . $currentpage;

        $data = [];

        if (config("setting.caching.status", false)) {
            $data = Cache::remember($cacheKey, config("setting.caching.time", 3600), function () use ($pagination) {
                return [
                    "posts" => Blog::active()->order()->paginate($pagination),
                    "popularPost" => Blog::active()->viewOrder()->take(5)->get(),
                    "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
                ];
            });
        } else {
            $data = [
                "posts" => Blog::active()->order()->paginate($pagination),
                "popularPost" => Blog::active()->viewOrder()->take(5)->get(),
                "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
            ];
        }

        return view("$this->folder.index", $data);
    }

    public function show(Blog $post)
    {
        $cacheKey = ModuleEnum::Blog->value . "_" . $post->id;
        $post->increment("view_count");
        $data = [];
        if (config("setting.caching.status", false)) {
            $data = Cache::remember($cacheKey, config("setting.caching.time", 3600), function () use ($post) {
                return [
                    "post" => $post,
                    "previousPost" => Blog::active()->order()->where("id", "<", $post->id)->first(),
                    "nextPost" => Blog::active()->order()->where("id", ">", $post->id)->first(),
                ];
            });
        } else {
            $data = [
                "post" => $post,
                "previousPost" => Blog::active()->order()->where("id", "<", $post->id)->first(),
                "nextPost" => Blog::active()->order()->where("id", ">", $post->id)->first(),
            ];
        }
        return view("$this->folder.show", $data);
    }
}
