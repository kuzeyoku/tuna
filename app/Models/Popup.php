<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Models\PopupTranslate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "image",
        "video",
        "url",
        "time",
        "width",
        "closeOnEscape",
        "closeButton",
        "overlayClose",
        "pauseOnHover",
        "fullScreenButton",
        "color",
        "status"
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
        return $this->hasMany(PopupTranslate::class);
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
            return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Popup->folder() . "/" . $this->image);
        return asset("assets/img/noimage.png");
    }
}
