<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SecretariaSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Secretaria',
            'email' => 'secretaria@gmail.com',
            'cep' => null,
            'numero_cel' => null,
            'password' => Hash::make('secretaria123'), 
            'role' => 3,
        ]);

        User::create([
            'name' => 'Psicologa',
            'email' => 'psicologa@gmail.com',
            'cep' => null,
            'numero_cel' => null,
            'password' => Hash::make('psicologa123'), 
            'role' => 2,
        ]);

        User::create([
            'name' => 'Carlos',
            'email' => 'Carlos@gmail.com',
            'cep' => '13086900',
            'numero_cel' => '(00) 00000-0000',
            'password' => Hash::make('carlos123'), 
            'role' => 1,
        ]);
    }
}