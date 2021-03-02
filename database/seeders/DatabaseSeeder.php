<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jemaat;
use App\Models\Keluarga;
use App\Models\DetailKeluarga;
use App\Models\Sektor;
use App\Models\Sintua;


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
        $this->call([
            UserSeeder::class,
        ]);

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
    
        //Keluarga & Jemaat (hanya bisa dibuat setelah membuat sektor)
        Keluarga::factory()->has( DetailKeluarga::factory()->has(Jemaat::factory())->count(3) )->count(13)->create();

        //SINTUA (hanya bisa dilakukan setelah membuat keluarga & sektor)
        $this->call([
            SintuaSeeder::class,
        ]);

    }
}

//\App\Models\Jemaat::factory()->create();
//Jemaat::factory()->has(DetailKeluarga::factory()->for(Keluarga::factory()))->create();