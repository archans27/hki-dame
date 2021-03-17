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
        Sektor::create([
            'id' => 1,
            'nama' => 'Sektor 01',
            'wilayah' => 'Cidurian, Margahayu, Sentosa Asih',
        ]);
        
        Sektor::create([
            'id' => 2,
            'nama' => 'Sektor 02',
            'wilayah' => 'Jl. Logam, Ciwastra, Bodogol , GBA, GBI',
        ]);
        
        Sektor::create([
            'id' => 3,
            'nama' => 'Sektor 03',
            'wilayah' => 'Bumi Harapan, Panyileukan, Bodogo, Riung Bandung, Sapan',
        ]);
        
        Sektor::create([
            'id' => 4,
            'nama' => 'Sektor 04',
            'wilayah' => 'Cibiru, Cileunyi',
        ]);
        
        Sektor::create([
            'id' => 5,
            'nama' => 'Sektor 05',
            'wilayah' => 'Cileunyi, Tanjung Sari, Rancaekek, Cicalengka, Majalaya',
        ]);
        
        Sektor::create([
            'id' => 6,
            'nama' => 'Sektor 06',
            'wilayah' => 'Cibiru , Cilengkrang, Cisaranten, Ujung Berung, Cicaheum',
        ]);
        
        Sektor::create([
            'id' => 7,
            'nama' => 'Sektor 07',
            'wilayah' => 'Cicaheum, Cicadas, Jl. Suci, Jl. Riau, Sadang Serang, Dago',
        ]);
        
        Sektor::create([
            'id' => 8,
            'nama' => 'Sektor 08',
            'wilayah' => '-',
        ]);
        
        Sektor::create([
            'id' => 9,
            'nama' => 'Sektor 09',
            'wilayah' => 'Buah Batu, Moch. Toha, Baleendah, Ciparay, Banjaran, Cibaduyut',
        ]);
        
        Sektor::create([
            'id' => 10,
            'nama' => 'Sektor 10',
            'wilayah' => 'Alun-alun, Kopo, Immanuel, Cibolerang, TKI, Cigondewah, Cibaduyut',
        ]);
        
        Sektor::create([
            'id' => 11,
            'nama' => 'Sektor 11',
            'wilayah' => 'Rancamanyar, Margahayu Kencana, Soreang, Ciwidey',
        ]);
        
        Sektor::create([
            'id' => 12,
            'nama' => 'Sektor 12',
            'wilayah' => 'Alun-alun, Sudirman, Cijerah, Cimahi',
        ]);
        
        Sektor::create([
            'id' => 13,
            'nama' => 'Sektor 13',
            'wilayah' => 'Padjadjaran, Sukajadi, Pasteur, Setiabudi, Lembang',
        ]);

        //Keluarga & Jemaat (hanya bisa dibuat setelah membuat sektor)
        // Keluarga::factory()->has( DetailKeluarga::factory()->has(Jemaat::factory())->count(3) )->count(13)->create();

        //SINTUA (hanya bisa dilakukan setelah membuat keluarga & sektor)
        /*$this->call([
            SintuaSeeder::class,
        ]);*/

    }
}

//\App\Models\Jemaat::factory()->create();
//Jemaat::factory()->has(DetailKeluarga::factory()->for(Keluarga::factory()))->create();