<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Jemaat;
use App\Models\Keluarga;
use App\Models\DetailKeluarga;
use App\Models\Sektor;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //USER
        User::create([
            'name' => 'Admin HKI',
            'email' => 'hkidame@mail.com',
            'password' => Hash::make('password')
        ]);

        //Keluarga
        Keluarga::factory()->has( DetailKeluarga::factory()->has(Jemaat::factory())->count(3) )->count(4)->create();

        //SEKTOR
        for ($i=1; $i <= 13 ; $i++) { 
            $nama = "Sektor ".$i;
            if ($i < 10){
                $nama = "Sektor 0".$i;
            }
            Sektor::factory()->create([
                'id' => $i,
                'nama' => $nama,
            ]);
        }

    }
}

//\App\Models\Jemaat::factory()->create();
//Jemaat::factory()->has(DetailKeluarga::factory()->for(Keluarga::factory()))->create();