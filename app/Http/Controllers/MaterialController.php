<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'categoria_nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:100|unique:materials,codigo',
            'unidad_medida' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
        ]);

        $resultado = DB::transaction(function () use ($datosValidados) {
            $categoria = Categoria::firstOrCreate([
                'nombre' => $datosValidados['categoria_nombre'],
            ]);

            $material = Material::create([
                'codigo' => $datosValidados['codigo'],
                'unidad_medida' => $datosValidados['unidad_medida'],
                'descripcion' => $datosValidados['descripcion'],
                'ubicacion' => $datosValidados['ubicacion'],
                'categoria_id' => $categoria->id,
            ]);

            return [
                'categoria' => $categoria,
                'material' => $material->load('categoria'),
            ];
        });

        return response()->json([
            'mensaje' => 'Material creado correctamente.',
            'categoria' => $resultado['categoria'],
            'material' => $resultado['material'],
        ], 201);
    }
}