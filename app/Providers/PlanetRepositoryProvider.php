<?php

namespace App\Providers;

use App\Repositories\EloquentPlanetRepository;
use App\Repositories\PlanetRepositories;
use Illuminate\Support\ServiceProvider;

class PlanetRepositoryProvider extends ServiceProvider
{

    public array $bindings = [
        PlanetRepositories::class => EloquentPlanetRepository::class
    ];
}
