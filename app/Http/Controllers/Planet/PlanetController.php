<?php

namespace App\Http\Controllers\Planet;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanetResource;
use App\Models\Planet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PlanetController extends Controller
{
    public function index()
    {
        cache()->put('nome', 'terra', 60);
        $value = cache()->get('nome');
        dd($value);
    }

    public function saveToCache()
    {
        $data = [
            'name' => 'Terra',
            'inhabited' => true,
        ];

        Cache::put('planet_data', $data, 60);

        return redirect('api/planets/list');
    }

    public function getInfo()
    {
        $planetData = Cache::get('planet_data');

        return response()->json(['data' => $planetData]);
    }
}
