<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $usuariosReales = [
            ['name' => 'Juan Pérez', 'email' => 'juan.perez@ejemplo.com'],
            ['name' => 'Ana Gómez', 'email' => 'ana.gomez@ejemplo.com'],
            ['name' => 'Luis Martínez', 'email' => 'luis.martinez@ejemplo.com'],
            ['name' => 'Carlos López', 'email' => 'carlos.lopez@ejemplo.com'],
            ['name' => 'Marta Sánchez', 'email' => 'marta.sanchez@ejemplo.com'],
            ['name' => 'David Rodríguez', 'email' => 'david.rodriguez@ejemplo.com'],
            ['name' => 'Sofía González', 'email' => 'sofia.gonzalez@ejemplo.com'],
            ['name' => 'Pedro Fernández', 'email' => 'pedro.fernandez@ejemplo.com'],
            ['name' => 'Isabel Pérez', 'email' => 'isabel.perez@ejemplo.com'],
            ['name' => 'Raúl Díaz', 'email' => 'raul.diaz@ejemplo.com'],
        ];

        foreach ($usuariosReales as $usuario) {
            User::create([
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'rol' => fake()->randomElement(['cliente', 'entrenador']), // Puedes ajustar el rol si lo necesitas
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
