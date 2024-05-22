<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Outras chamadas de seeders, se houver
        $this->call(SecretariaSeeder::class);
    }
}
