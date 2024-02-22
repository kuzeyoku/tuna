<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleryVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        "galery_id",
        "video"
    ];
}
