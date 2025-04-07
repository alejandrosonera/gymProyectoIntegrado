<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clase>
 */
class ClaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->unique()->sentence(4, true),
            'descripcion'=>fake()->text(),
            'fecha_hora'=>now()->addDays(1),
            'max_participantes'=>random_int(5, 25),
            'entrenador_id'=> User::where('rol', 'entrenador')->inRandomOrder()->first()?->id,
        ];
    }
}
