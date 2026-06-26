<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presupuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_presupuesto',
        'nombre_presupuesto',
        'unidad_id',
    ];

    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }

    public function materialUnidades(): HasMany
    {
        return $this->hasMany(MaterialUnidad::class);
    }
}
