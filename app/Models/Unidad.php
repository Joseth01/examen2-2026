<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MaterialUnidad;

class Unidad extends Model
{
    protected $table = 'unidades';
    protected $primaryKey = 'idUnidad';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
    ];

    public function materialesUnidad()
    {
        return $this->hasMany(MaterialUnidad::class, 'idUnidad', 'idUnidad');
    }

    //public function usuarios()
   // {
       // return $this->hasMany(Usuario::class, 'idUnidad', 'idUnidad');
   // }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'idUnidad', 'idUnidad');
    }
}