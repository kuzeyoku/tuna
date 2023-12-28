<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
    ];

    public $timestamps = false;

    public function getImageUrl()
    {
        return asset("storage/" . config("setting.image.folder", "image") . "/" . ModuleEnum::Product->folder() . "/" . $this->image);
    }
}
