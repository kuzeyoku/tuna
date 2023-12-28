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

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order");
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
        if (array_key_exists($this->locale, $this->title)) {
            return $this->title[$this->locale];
        }
        return null;
    }

    public function getDescription()
    {
        if (array_key_exists($this->locale, $this->description)) {
            return $this->description[$this->locale];
        }
        return null;
    }

    public function getFeatures()
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

    public function getUrl()
    {
        return route(ModuleEnum::Project->route() . ".show", [$this, $this->slug]);
    }

    public function getImageUrl()
    {
        if ($this->image)
            return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Project->folder() . "/" . $this->image);
        return asset("assets/img/noimage.png");
    }

}
