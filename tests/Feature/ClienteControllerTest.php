<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCrearCliente()
    {
        $response = $this->post('/clientes', [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'cedula' => 123456789,
            'departamento' => 'Cundinamarca',
            'ciudad' => 'Bogota',
            'celular' => 1234567890,
            'correo_electronico' => 'juan@example.com',
            'habeas_data' => true,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('clientes', ['nombre' => 'Juan']);
    }

  

    public function testObtenerTodosLosClientes()
    {
        $clientes = Cliente::factory()->count(3)->create();

        $response = $this->get('/clientes');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function testSeleccionarGanador()
    {
        Cliente::factory()->count(5)->create();

        $response = $this->get('/clientes/ganador');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'nombre',
            'apellido',
            'cedula',
            'departamento',
            'ciudad',
            'celular',
            'correo_electronico',
            'habeas_data',
            'created_at',
            'updated_at',
        ]);
    }
}
