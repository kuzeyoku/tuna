<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Galery;

class GaleryController extends Controller
{
    public function index()
    {
        $galeries = Galery::active()->order()->get();
        return view("galery.index", compact("galeries"));
    }

    public function show(Galery $galery)
    {
        return view('galery.show', compact('galery'));
    }
}
