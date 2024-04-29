<?php
namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'apellido' => $this->faker->lastName,
            'cedula' => $this->faker->randomNumber(),
            'departamento' => $this->faker->state,
            'ciudad' => $this->faker->city,
            'celular' => $this->faker->phoneNumber,
            'correo_electronico' => $this->faker->email,
            'habeas_data' => $this->faker->boolean,
        ];
    }
}
