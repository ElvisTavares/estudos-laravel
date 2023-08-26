<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\satellite;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $casts = [
        'inhabited' => 'boolean',
    ];

    protected $appends = ['links'];

    public function satellites(): HasMany
    {
        return $this->hasMany(Satellite::class);
    }

    // public function inhabited(): Attribute
    // {
    //     return new Attribute(
    //         get: fn($inhabited) => (bool) $inhabited,
    //     );
    // }

    public function links(): Attribute
    {
        return new Attribute(
            get: fn () => [
                'rel' => 'self',
                'url' => "api/planets/{$this->id}"
            ]
            );
    }
}
