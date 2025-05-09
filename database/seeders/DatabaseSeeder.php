<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    protected static ?string $password;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear manualmente un usuario admin
    User::create([
            'name' => 'Alejandro Sonera Benzal',
            'email' => 'adminsonera@gmail.com',
            'email_verified_at' => now(),
            'password' => 'sonera',
            'two_factor_secret' => null,
            'rol' => 'admin',
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => 'https://randomuser.me/api/portraits/men/' . rand(1, 99) . '.jpg',
            'current_team_id' => null,
    ]);

        User::factory(15)->create();

        Storage::deleteDirectory('images/productos');
        Storage::makeDirectory('images/productos');

        $this->call(ClaseSeeder::class);
        $this->call(ProductoSeeder::class);
    }
}
