<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'status',
        'category_id',
        'user_id',
        "image",
        "order"
    ];

    protected $locale;

    protected $with = ["category", "translate", "user"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session()->get("locale");
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order", "asc");
    }

    public function scopeViewOrder($query)
    {
        return $query->orderBy("view_count", "desc");
    }

    public function translate()
    {
        return $this->hasMany(BlogTranslate::class, 'post_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('title')->first();
    }

    public function getTitlesAttribute()
    {
        return $this->translate->pluck('title', "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('description')->first();
    }

    public function getDescriptionsAttribute()
    {
        return $this->translate->pluck('description', "lang")->all();
    }

    public function getTagsAttribute()
    {
        return $this->translate->pluck('tags', "lang")->all();
    }

    public function getTagsToArrayAttribute()
    {
        return explode(",", $this->translate->pluck('tags', "lang")->first());
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->description), 100);
    }

    public function getUrlAttribute()
    {
        return route(ModuleEnum::Blog->route() . ".show", [$this->id, $this->slug]);
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image))
            return asset("assets/img/noimage.png");
        return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Blog->folder() . "/" . $this->image);
    }

    public function getCategoryTitleAttribute()
    {
        return $this->category->title ?? __("admin/general.uncategorized");
    }

    public function getCategoryUrlAttribute()
    {
        return route(ModuleEnum::Blog->route() . ".category", [$this->category->id, $this->category->slug]);
    }
}
