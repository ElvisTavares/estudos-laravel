<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\satellite;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planet extends Model
{
    use HasFactory;

    protected $table = 'planets';

    protected $fillable = [
        'name',
        'type',
        'size',
        'average_temperature',
        'gravity',
    ];

    public function satellites(): HasMany
    {
        return $this->hasMany(Satellite::class);
    }
}
