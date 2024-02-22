<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galery extends Model
{
    use HasFactory;

    protected $fillable = [
        "slug",
        "image",
        "type",
        "order",
        "status"
    ];

    protected $with = ["translate"];

    protected $locale;

    public function __construct()
    {
        parent::__construct();
        $this->locale = session()->get("locale");
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function translate()
    {
        return $this->hasMany(GaleryTranslate::class);
    }

    public function images()
    {
        return $this->hasMany(GaleryImage::class);
    }

    public function videos()
    {
        return $this->hasMany(GaleryVideo::class);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order", "asc");
    }

    public function getTitlesAttribute()
    {
        return  $this->translate->pluck("title", "lang")->all();
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

    public function getUrlAttribute()
    {
        return route(ModuleEnum::Galery->route() . ".show", [$this->id, $this->slug]);
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image))
            return asset("assets/img/noimage.png");
        return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Galery->folder() . "/" . $this->image);
    }
}
