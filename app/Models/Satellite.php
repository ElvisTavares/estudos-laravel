<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Satellite extends Model
{
    use HasFactory;

    protected $table = 'satellites';
    
    protected $fillable = [
        'name',
        'type',
        'size',
        'orbit',
        'planet_id',
    ];

    public function planet(): BelongsTo
    {
        return $this->belongsTo(Satellite::class);
    }
}
