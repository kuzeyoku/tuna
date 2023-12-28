<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationTranslate extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "education_id",
        "lang",
    ];

    public $timestamps = false;
}
