<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jemaat = Jemaat::where('is_pindah', 0)->where('hidup',1)->get();
        $count_l=0;$count_p=0;$count_jkl=0;
        $count_a=0;$count_b=0;$count_ab=0;$count_o=0;$count_goldal=0;
        foreach ($jemaat as $key => $value) {
            switch ($value->jenis_kelamin) {
                case 'Laki-laki':
                    $count_l++;
                    break;
                case 'Perempuan':
                    $count_p++;
                    break;
                
                default:
                    $count_jkl++;
                    break;
            }

            switch ($value->golongan_darah) {
                case 'A':
                    $count_a++;
                    break;
                case 'B':
                    $count_b++;
                    break;
                case 'AB':
                    $count_ab++;
                    break;
                case 'O':
                    $count_o++;
                    break;
                
                default:
                    $count_goldal++;
                    break;
            }
        }
        $count_jk = [$count_l,$count_p,$count_jkl];
        $count_golda = [$count_a,$count_b,$count_ab,$count_o,$count_goldal];
        $keluarga =  DB::table('keluarga')
            ->select('keluarga.*', 'sektor.nama as nama_sektor')
            ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->join('sektor', 'keluarga.sektor_id', '=', 'sektor.id')
            ->where('is_pindah', 0)
            ->distinct()->get();
        return view('dashboard', ['jemaat' => $jemaat->count(), 'keluarga' => $keluarga->count(), 'count_jk' => $count_jk, 'count_golda' => $count_golda]);
    }
}