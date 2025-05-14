<?php

namespace Database\Seeders;

use App\Models\Clase;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $entrenadores = User::where('rol', 'entrenador')->pluck('id')->shuffle()->values();
        $clientes = User::where('rol', 'cliente')->pluck('id')->toArray();

        $clases = collect([
            Clase::create([
                'nombre' => 'Clase de Cardio Avanzado',
                'descripcion' => 'Entrenamiento de alta intensidad enfocado en mejorar tu resistencia cardiovascular.',
                'fecha_hora' => '2025-05-15 18:00:00',
                'max_participantes' => 20,
                'entrenador_id' => $entrenadores->get(0),
            ]),
            Clase::create([
                'nombre' => 'Yoga al Amanecer',
                'descripcion' => 'Clase suave de yoga para comenzar el día con energía y equilibrio.',
                'fecha_hora' => '2025-05-16 07:30:00',
                'max_participantes' => 15,
                'entrenador_id' => $entrenadores->get(1),
            ]),
            Clase::create([
                'nombre' => 'Funcional Full Body',
                'descripcion' => 'Ejercicios funcionales para trabajar todo el cuerpo usando tu propio peso.',
                'fecha_hora' => '2025-05-17 10:00:00',
                'max_participantes' => 18,
                'entrenador_id' => $entrenadores->get(2),
            ]),
            Clase::create([
                'nombre' => 'HIIT Express 30\'',
                'descripcion' => 'Entrenamiento en intervalos de alta intensidad para quemar grasa rápidamente.',
                'fecha_hora' => '2025-05-18 19:00:00',
                'max_participantes' => 12,
                'entrenador_id' => $entrenadores->get(3),
            ]),
            Clase::create([
                'nombre' => 'Pilates Rehabilitativo',
                'descripcion' => 'Clase de pilates enfocada en mejorar la postura y fortalecer el core.',
                'fecha_hora' => '2025-05-19 17:00:00',
                'max_participantes' => 10,
                'entrenador_id' => $entrenadores->get(4),
            ]),
        ]);

        foreach ($clases as $clase) {
            shuffle($clientes);
            $clase->clientes()->attach($this->getRandomArrayId($clientes));
        }
    }

    private function getRandomArrayId(array $ids)
    {
        return array_slice($ids, 0, random_int(1, max(1, count($ids) - 1)));
    }
}
