<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return ServiceResource::collection($services);
    }
}
