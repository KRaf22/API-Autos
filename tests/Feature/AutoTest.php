<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Auto;

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

    public function test_EliminarUnoExistente(){

        $response=$this->delete('/api/autos/80');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "mensaje" => "El auto con el id 80 ha sido eliminado correctamente"
       ]);

       $this->assertDatabaseMissing('autos', [
        'id' => '80',
        'deleted_at' => null
       ]);

       Auto::withTrashed()->where("id",80)->restore();
    }

    public function test_EliminarUnoInexistente(){

        $response=$this->delete('/api/autos/232332');

        $response->assertStatus(404);
    }

    public function test_ModificarUnoInexistente(){

        $response=$this->post('/api/autos/232332');

        $response->assertStatus(404);
    }

    public function test_ModificarUnoExistente(){

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

        $response = $this->post('/api/autos/80',[
            "marca" => "Ferrari",
            "modelo" => "296 GTB",
            "color" => "rojo",
            "puertas" => 2,
            "cilindrado" => 16,
            "automatico" => true,
            "electrico" => true
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure($estructura);

        $response-> assertJsonFragment([
            "marca" => "Ferrari",
            "modelo" => "296 GTB",
            "color" => "rojo",
            "puertas" => 2,
            "cilindrado" => 16,
            "automatico" => true,
            "electrico" => true
        ]);

    }

    public function test_InsertarAuto(){

        $response = $this->post('/api/autos',[
            "marca" => "Volkswagen",
            "modelo" => "Tipo 1",
            "color" => "plateado",
            "puertas" => 4,
            "cilindrado" => 4,
            "automatico" => false,
            "electrico" => false
        ]);

        $response->assertStatus(201);

        $response->assertJsonCount(10);

        $this->assertDatabaseHas('autos', [
            "marca" => 'Volkswagen',
            "modelo" => 'Tipo 1',
            "color" => "plateado",
            "puertas" => 4,
            "cilindrado" => 4,
            "automatico" => false,
            "electrico" => false
        ]);
    } 
}
