<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ListarTodos()
    {
        $response = $this->get('/api/autos');

        $response->assertStatus(200);
    }

    public function test_ListarUnoExistente(){

        $estructura= [
            "id",
            "marca",
            "modelo",
            "color",
            "puertas",
            "cilindrado",
            "automatico",
            "electrico",
            "created_at",
            "updated_at",
            "deleted_at"
        ];

        $response = $this->get('/api/autos/77');

        $response->assertStatus(200);

        $response->assertJsonCount(11);

        $response->assertJsonStructure($estructura);

    }

    public function test_ListarUnoInexistente(){

        $response = $this->get('/api/autos/8752');

        $response->assertStatus(404);
        
    }
}
