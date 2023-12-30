<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
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

    public function __construct()
    {
        parent::__construct();
        $this->locale = session()->get("locale");
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

    public function getTitleAttribute()
    {
        return $this->translate->pluck('title', "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->pluck('description', "lang")->all();
    }

    public function getTagsAttribute()
    {
        return $this->translate->pluck('tags', "lang")->all();
    }

    public function getTitle()
    {
        if (array_key_exists($this->locale, $this->title))
            return $this->title[$this->locale];
        return null;
    }

    public function getShortDescription(int $length = 100)
    {
        if (array_key_exists($this->locale, $this->description))
            return mb_substr(strip_tags($this->description[$this->locale]), 0, $length) . "...";
        return null;
    }

    public function getDescription()
    {
        if (array_key_exists($this->locale, $this->description))
            return $this->description[$this->locale];
        return null;
    }

    public function getTags()
    {
        if (array_key_exists($this->locale, $this->tags))
            return array_map(function ($item) {
                return trim($item);
            }, explode(",", $this->tags[$this->locale]));
        return [];
    }

    public static function uniqueTags()
    {
        $tags = BlogTranslate::pluck("tags")->toArray();
        $tags = array_map(function ($item) {
            return explode(",", $item);
        }, $tags);
        $tags = array_merge(...$tags);
        $tags = array_unique($tags);
        return array_slice($tags, 0, 10);
    }

    public function getUrl()
    {
        return route(ModuleEnum::Blog->route() . ".show", [$this->id, $this->slug]);
    }

    public function getImageUrl()
    {
        if ($this->image)
            return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Blog->folder() . "/" . $this->image);
        return asset("assets/img/noimage.png");
    }

    public function getCategoryTitle()
    {
        if ($this->category_id == 0)
            return __("admin/general.uncategorized");
        return $this->category->getTitle();
    }

    public function getCategoryUrl()
    {
        return route(ModuleEnum::Blog->route() . ".category", [$this->category->id, $this->category->slug]);
    }

    public function getCreatedDate()
    {
        return date("d m Y", strtotime($this->created_at));
    }
}
