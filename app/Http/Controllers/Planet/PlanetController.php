<?php

namespace App\Http\Controllers\Planet;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanetResource;
use App\Models\Planet;
use Illuminate\Http\Request;

class PlanetController extends Controller
{
    public function index()
    {
        $planets = Planet::all();
        
       return PlanetResource::collection($planets);
    }
}
