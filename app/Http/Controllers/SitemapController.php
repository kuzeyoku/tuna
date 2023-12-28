<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Category;
use App\Enums\StatusEnum;
use App\Models\Education;

class SitemapController extends Controller
{
    public function index()
    {
        $pages = Page::whereStatus(StatusEnum::Active->value)->get();
        $posts = Blog::whereStatus(StatusEnum::Active->value)->get();
        $categories = Category::whereStatus(StatusEnum::Active->value)->get();
        $services = Service::whereStatus(StatusEnum::Active->value)->get();
        $projects = Project::whereStatus(StatusEnum::Active->value)->get();
        $products = Product::whereStatus(StatusEnum::Active->value)->get();
        $educations = Education::whereStatus(StatusEnum::Active->value)->get();
        $view = view("sitemap", compact("pages", "posts", "categories", "services", "projects", "products", "educations"));
        return response($view)->header("Content-Type", "text/xml");
    }
}
