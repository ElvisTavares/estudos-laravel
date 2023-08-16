<?php

namespace App\Http\Controllers\Planet;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanetResource;
use App\Models\Planet;
use App\Repositories\PlanetRepositories;
use Illuminate\Http\Request;

class PlanetController extends Controller
{

    public function __construct(private PlanetRepositories $planetRepositories)
    {

    }

    public function index()
    {
        $planets = Planet::all();
        
       return PlanetResource::collection($planets);
    }

    public function store(Request $request)
    {
        $attributes = [
            'name' => $request->name,
            'type' => $request->type,
            'size' => $request->size,
            'average_temperature' => $request->average_temperature,
            'gravity' => $request->gravity,
        ];

        return response()->json($this->planetRepositories->add($attributes));
        //return response()->json(Planet::create($request->all()), 201);
    }

    public function show(int $id)
    {
        $planet = Planet::with('satellites')->find($id);

        if($planet === null) {
            return response()->json(['message' => 'Planet not found'], 404);
        }

        return $planet;
    }

    public function update(Planet $planet, Request $request)
    {
        $planet->fill($request->all());
        $planet->save();

        return $planet;
    }

    public function destroy(int $planet)
    {
        Planet::destroy($planet);
        return response()->noContent();
    }
}
