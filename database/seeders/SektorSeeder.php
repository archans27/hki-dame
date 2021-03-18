<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sektor;

class SektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
