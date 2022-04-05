<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "paterno"=>$this->faker->name(),
            "materno"=>$this->faker->name(),
            "nombres"=>$this->faker->name(),
            "ci"=>$this->faker->numberBetween(7330000,7340000),
            "cargo"=>$this->faker->name(),
            "foto"=>"",
            "sueldo"=>$this->faker->numberBetween(2000,15000),
            "fecharegistro"=>now(),
        ];
    }
}
