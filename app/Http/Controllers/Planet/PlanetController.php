<?php

namespace App\Http\Controllers\Planet;

use App\Exceptions\PlanetNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanetResource;
use App\Models\Planet;
use App\Repositories\PlanetRepositories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
     
        try {
            $planet = Planet::with('satellites')->find($id);
            throw new PlanetNotFoundException('Erro');
            return $planet;
        } catch (PlanetNotFoundException $e) {
            Log::error('Planet Not found');
            return view('error.planet', ['message' => $e->getMessage()]);
        }
        // if($planet === null) {
        //     return response()->json(['message' => 'Planet not found'], 404);
        // }
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

    public function getPlanet()
    {
        //chave unica para este cache
        $cacheKey = 'planetas';

        //verifica se os dados estao salvo em cache
        if(Cache::has($cacheKey)) {
            //se os dados estiverem em cache, recupereos do cache
            $planetas = Cache::get($cacheKey);
        } else {
            //se os dados nao estiverem em cache, consulta o banco
            $planetas = Planet::all();
            //armazena os dados em cache por 10 minutos
            Cache::put($cacheKey, $planetas, now()->addMinutes(10));
        }

        return response()->json(['planets' => $planetas]);
    }
}
