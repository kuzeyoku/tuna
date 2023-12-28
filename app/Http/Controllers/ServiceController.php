<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Reference;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::active()->order()->get();
        $reference = Reference::active()->order()->get();
        return view("service.index", compact("service", "reference"));
    }

    public function show(Service $service)
    {
        $otherServices = Service::getOther($service->id, 3);
        return view("service.show", compact("service", "otherServices"));
    }
}
