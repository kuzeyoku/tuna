<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        "url",
        "image",
        "status",
        "order"
    ];

    public function scopeActive($query)
    {
        return $query->where("status", StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order", "asc");
    }

    public function getImageUrl()
    {
        if ($this->image)
            return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Reference->folder() . "/" . $this->image);
        return asset("assets/img/noimage.png");
    }
}
