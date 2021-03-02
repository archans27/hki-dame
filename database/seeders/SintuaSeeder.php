<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sintua;
use DB;

class SintuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keluargas =  DB::table('keluarga')->select('keluarga.*', 'sektor.nama as nama_sektor')
            ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->join('sektor', 'keluarga.sektor_id', '=', 'sektor.id')
            ->distinct('sektor.id')
            ->get()
        ;

        foreach($keluargas as $keluarga){
            $sintua = new Sintua();
            $sintua->jemaat_id = $keluarga->kepala_keluarga_id;
            $sintua->sektor_id = $keluarga->sektor_id;
            $sintua->save();
        }
    }
}
