<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GaleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        "galery_id",
        "image"
    ];

    public $timestamps = false;

    public function getImageUrlAttribute()
    {
        if (is_null($this->image))
            return asset("assets/img/noimage.png");
        return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Galery->folder() . "/" . $this->image);
    }
}
