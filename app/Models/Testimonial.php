<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        "image",
        "name",
        "company",
        "position",
        "message",
        "status",
        "order"
    ];

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order");
    }

    public function getImageUrl()
    {
        return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Testimonial->folder() . "/" . $this->image);
    }
}
