<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        "url",
        "type",
        "parent_id",
        "order",
        "blank",
    ];

    public $timestamps = false;

    protected $locale;

    protected $with = ["translate", "subMenu"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session()->get("locale");
    }

    public function translate()
    {
        return $this->hasMany(MenuTranslate::class);
    }

    public function subMenu()
    {
        return $this->hasMany(Menu::class, "parent_id");
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

    public static function toSelectArray($type)
    {
        return Menu::whereType($type)->get()->pluck("titles." . app()->getLocale(), "id")->toArray();
    }

}
