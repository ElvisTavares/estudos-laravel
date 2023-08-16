<?php

namespace App\Repositories;

use App\Models\Planet;

class EloquentPlanetRepository implements PlanetRepositories
{
    public function add(array $attributes)
    {
        return Planet::create($attributes);
    }
}
