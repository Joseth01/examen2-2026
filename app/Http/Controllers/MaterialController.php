<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function index(): JsonResponse
    {
        $materiales = Material::with('categoria')->get();

        return response()->json($materiales);
    }

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

     public function update(Request $request, int $codigo): JsonResponse
    {
        $material = Material::find($codigo);

        if (!$material) {
            return response()->json([
                'message' => 'Material no encontrado.',
            ], 404);
        }

        $validated = $request->validate([
            'unidadMedida'  => 'sometimes|required|string|max:255',
            'descripcion'   => 'sometimes|required|string|max:500',
            'ubicacion'     => 'sometimes|required|string|max:255',
            'idCategoria'   => 'sometimes|required|integer|exists:categorias,idCategoria',
        ]);

        $material->update($validated);

        return response()->json([
            'message'  => 'Material actualizado correctamente.',
            'material' => $material->load('categoria'),
        ], 200);
    }
}

