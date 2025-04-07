<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre'=>'Membresia mensual',
            'descripcion'=>'Acceso completo al gimnasio durante un mes',
            'precio'=>30.00,
            'stock'=>100,
            'imagen'=>'membresia.jpg',
        ]);

        Producto::create([
            'nombre'=>'Proteina en Polvo',
            'descripcion'=>'Proteina Whey de alta calidad',
            'precio'=>45.00,
            'stock'=>50,
            'imagen'=>'proteina.jpg',
        ]);

    }
}
