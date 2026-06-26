<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    public function dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente(): void
    {
        $datosMaterial = [
            'categoria_nombre' => 'Papelería',
            'codigo' => 'MAT-001',
            'unidad_medida' => 'unidad',
            'descripcion' => 'Resma de papel tamaño carta',
            'ubicacion' => 'Bodega principal',
        ];

        $this->assertDatabaseMissing('materials', [
            'codigo' => 'MAT-001',
        ]);

        $respuesta = $this->postJson('/api/materiales', $datosMaterial);

        $respuesta
            ->assertStatus(201)
            ->assertJsonPath('mensaje', 'Material creado correctamente.')
            ->assertJsonPath('material.codigo', 'MAT-001')
            ->assertJsonPath('material.categoria.nombre', 'Papelería');

        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Papelería',
        ]);

        $this->assertDatabaseHas('materials', [
            'codigo' => 'MAT-001',
            'unidad_medida' => 'unidad',
            'descripcion' => 'Resma de papel tamaño carta',
            'ubicacion' => 'Bodega principal',
        ]);
    }
}