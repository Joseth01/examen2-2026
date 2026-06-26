<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialUnidad extends Model
{
    protected $table = 'material_unidad';
    protected $primaryKey = 'idMaterialUnidad';
    public $timestamps = true;

    protected $fillable = [
        'cantidad',
        'idUnidad',
        'idMaterial',
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'idUnidad', 'idUnidad');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'idMaterial', 'codigo');
    }

    public function presupuestos()
    {
        return $this->belongsToMany(
            Presupuesto::class,
            'material_unidad_presupuesto',
            'idMaterialUnidad',
            'codigoPresupuesto'
        );
    }
}