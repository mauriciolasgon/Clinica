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
    }
}