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
        'nombre' => 'Membresía mensual',
        'descripcion' => 'Acceso completo al gimnasio durante un mes',
        'precio' => 30.00,
        'stock' => 100,
        'imagen' => 'membresia.jpg',
    ]);

    Producto::create([
        'nombre' => 'Proteína en Polvo',
        'descripcion' => 'Proteína Whey de alta calidad',
        'precio' => 45.00,
        'stock' => 50,
        'imagen' => 'proteina.jpg',
    ]);

    Producto::create([
        'nombre' => 'Suplemento de Creatina',
        'descripcion' => 'Mejora el rendimiento físico y la recuperación',
        'precio' => 25.00,
        'stock' => 70,
        'imagen' => 'creatina.jpg',
    ]);

    Producto::create([
        'nombre' => 'Barras de proteína',
        'descripcion' => 'Barras energéticas ricas en proteína para el entrenamiento',
        'precio' => 12.00,
        'stock' => 150,
        'imagen' => 'barras_proteina.jpg',
    ]);

    Producto::create([
        'nombre' => 'Camiseta deportiva',
        'descripcion' => 'Camiseta transpirable y cómoda para entrenamientos',
        'precio' => 15.00,
        'stock' => 200,
        'imagen' => 'camiseta_deportiva.jpg',
    ]);

    Producto::create([
        'nombre' => 'Zapatillas de entrenamiento',
        'descripcion' => 'Zapatillas deportivas cómodas para el gimnasio',
        'precio' => 70.00,
        'stock' => 80,
        'imagen' => 'zapatillas.jpg',
    ]);

    Producto::create([
        'nombre' => 'Bebida isotónica',
        'descripcion' => 'Bebida para recuperar electrolitos durante el entrenamiento',
        'precio' => 3.50,
        'stock' => 300,
        'imagen' => 'bebida_isotonica.jpg',
    ]);

    Producto::create([
        'nombre' => 'Guantes de gimnasio',
        'descripcion' => 'Guantes para mayor confort y protección durante el entrenamiento',
        'precio' => 10.00,
        'stock' => 120,
        'imagen' => 'guantes_gimnasio.jpg',
    ]);

    Producto::create([
        'nombre' => 'Bandas elásticas',
        'descripcion' => 'Perfectas para ejercicios de estiramiento y fuerza',
        'precio' => 20.00,
        'stock' => 90,
        'imagen' => 'bandas_elasticas.jpg',
    ]);

    Producto::create([
        'nombre' => 'Botella de agua',
        'descripcion' => 'Botella reutilizable para mantenerte hidratado durante el entrenamiento',
        'precio' => 8.00,
        'stock' => 200,
        'imagen' => 'botella_agua.jpg',
    ]);
}

}
