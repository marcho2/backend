<?php

namespace Database\Seeders;

use App\Models\Producto;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Producto::create([
            'producto' => 'PC gamer',
            'precio' => 1500000,
            'fecha_de_ingreso' => '2024-11-19',
        ]);
    
        Producto::create([
            'producto' => 'Ejemplo',
            'precio' => 100,
            'fecha_de_ingreso' => '2024-11-19',
        ]);
    }
    

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
    
}
