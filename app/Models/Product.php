<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
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

    public function scopeActive()
    {
        return $this->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder()
    {
        return $this->orderBy("order");
    }

    public function getTitleAttribute()
    {
        return $this->translate->pluck("title", "lang")->toArray();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->pluck("description", "lang")->toArray();
    }

    public function getFeaturesAttribute()
    {
        return $this->translate->pluck("features", "lang")->toArray();
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

    public function getFeatures()
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

    public function getUrl()
    {
        return route(ModuleEnum::Product->route() . ".show", [$this->id, $this->slug]);
    }

    public function getImageUrl()
    {
        if ($this->image)
            return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Product->folder() . "/" . $this->image);
        return asset("assets/img/noimage.png");
    }

    public function getBrochureUrl()
    {
        if ($this->brochure)
            return asset("storage/" . config("setting.file.folder", "file") . "/" . ModuleEnum::Product->folder() . "/" . $this->brochure);
        return null;
    }
}
