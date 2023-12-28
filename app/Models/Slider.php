<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        "image",
        "button",
        "video",
        "status",
        "order"
    ];

    protected $locale;

    protected $with = ["translate"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session()->get("locale");
    }

    public function translate()
    {
        return $this->hasMany(SliderTranslate::class);
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

    public function getImageUrl()
    {
        if ($this->image)
            return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Slider->folder() . "/" . $this->attributes["image"]);
        return asset("assets/img/noimage.png");
    }
}
