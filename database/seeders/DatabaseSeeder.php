<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin HKI',
            'email' => 'hkidame@mail.com',
            'password' => Hash::make('password')
        ]);
        \App\Models\Jemaat::factory(20)->create();
    }
}
