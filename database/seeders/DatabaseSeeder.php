<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345'),
            'tipo' => 'administrador',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Proveedor User',
            'email' => 'proveedor@example.com',
            'password' => bcrypt('proveedorpassword'),
            'tipo' => 'proveedor',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Cliente User',
            'email' => 'cliente@example.com',
            'password' => bcrypt('clientepassword'),
            'tipo' => 'cliente',

        ]);
        
    }
}
