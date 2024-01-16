<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "slug",
        "category_id",
        "image",
        "brochure",
        "video",
        "order"
    ];

    protected $locale;

    protected $with = ["translate", "category", "images"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session()->get("locale");
    }

    public function scopeActive()
    {
        return $this->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder()
    {
        return $this->orderBy("order");
    }

    public function translate()
    {
        return $this->hasMany(ProductTranslate::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getTitlesAttribute()
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('title')->first();
    }

    public function getDescriptionsAttribute()
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('description')->first();
    }

    public function getFeaturesAttribute()
    {
        return $this->translate->pluck("features", "lang")->all();
    }

    public function getFeatureAttribute()
    {
        $result = [];
        if (array_key_exists($this->locale, $this->features)) {
            $featuresLine = array_filter(explode("\r\n", $this->features[$this->locale]), function ($item) {
                return !empty($item);
            });
            $result = [];
            array_map(function ($item) use (&$result) {
                list($key, $value) = explode(":", $item);
                $result[$key] = $value;
            }, $featuresLine);
            return $result;
        }
        return $result;
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->description), 100);
    }

    public function getUrlAttribute()
    {
        return route(ModuleEnum::Product->route() . ".show", [$this->id, $this->slug]);
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image))
            return asset("assets/img/noimage.png");
        return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Product->folder() . "/" . $this->image);
    }
}
