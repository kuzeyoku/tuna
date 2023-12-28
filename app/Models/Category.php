<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'status',
        'module',
        'parent_id',
        "order"
    ];

    protected $locale;

    protected $with = ["translate"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session()->get("locale");
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function translate()
    {
        return $this->hasMany(CategoryTranslate::class);
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order", "asc");
    }

    public function getTitleAttribute()
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getTitle()
    {
        if (array_key_exists($this->locale, $this->title))
            return $this->title[$this->locale];
        return null;
    }

    public function getDescription()
    {
        if (array_key_exists($this->locale, $this->description))
            return $this->description[$this->locale];
        return null;
    }

    public function countProducts()
    {
        return $this->products()->count();
    }

    public function countProjects()
    {
        return $this->projects()->count();
    }

    public function countServices()
    {
        return $this->services()->count();
    }

    public function countBlogs()
    {
        return $this->blogs()->count();
    }

    public function getUrl(ModuleEnum $module)
    {
        return route($module->route() . ".category", [$this->id, $this->slug]);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($category) {
            $category->products()->update(["category_id" => 0]);
            $category->projects()->update(["category_id" => 0]);
            $category->services()->update(["category_id" => 0]);
            $category->blogs()->update(["category_id" => 0]);
        });
    }
}
