<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requisicion extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'estado',
        'unidad_id',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }
}
