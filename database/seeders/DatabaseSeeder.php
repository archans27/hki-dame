<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Jemaat;
use App\Models\Keluarga;
use App\Models\DetailKeluarga;


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
        //\App\Models\Jemaat::factory()->create();
        //Jemaat::factory()->has(DetailKeluarga::factory()->for(Keluarga::factory()))->create();

        Keluarga::factory()->has( DetailKeluarga::factory()->has(Jemaat::factory())->count(3) )->count(4)->create();
    }
}
