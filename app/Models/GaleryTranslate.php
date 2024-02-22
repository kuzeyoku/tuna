<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleryTranslate extends Model
{
    use HasFactory;

    protected $fillable = [
        "galery_id",
        "lang",
        "title"
    ];

    public $timestamps = false;
}
