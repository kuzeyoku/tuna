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
        return $this->hasMany(SliderTranslate::class);
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck("title")->first();
    }

    public function getTitlesAttribute()
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck("description")->first();
    }

    public function getDescriptionsAttribute()
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image))
            return asset("assets/img/noimage.png");
        return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Slider->folder() . "/" . $this->image);
    }
}
