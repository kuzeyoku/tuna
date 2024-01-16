<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        "slug",
        "category_id",
        "image",
        "video",
        "model3D",
        "order",
        "status"
    ];

    protected $locale;

    protected $with = ["translate", "category", "images"];

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
        return $query->orderBy("order");
    }

    public function translate()
    {
        return $this->hasMany(ProjectTranslate::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function getTitlesAttribute()
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck("title")->first();
    }

    public function getDescriptionsAttribute()
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck("description")->first();
    }

    public function getFeaturesAttribute()
    {
        return $this->translate->pluck("features", "lang")->toArray();
    }

    public function getFeatureAttribute()
    {
        $result = [];
        if (array_key_exists($this->locale, $this->features)) {
            $featuresLine = array_filter(explode("\r\n", $this->features[$this->locale]), function ($item) {
                return !empty($item);
            });
            array_map(function ($item) use (&$result) {
                list($key, $value) = explode(":", $item);
                $result[$key] = $value;
            }, $featuresLine);
        }
        return $result;
    }

    public function getUrlAttribute()
    {
        return route(ModuleEnum::Project->route() . ".show", [$this, $this->slug]);
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image))
            return asset("assets/img/noimage.png");
        return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Project->folder() . "/" . $this->image);
    }
}
