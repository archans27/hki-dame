<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use Response;
use DB;

class KeluargaController extends Controller
{
    private $limit = 5;

    public function index(Request $request)
    {
        $keluarga=Keluarga::where('kepala_keluarga', 'like', "%$request->hint%")->limit($this->limit)->get();
	    return Response::json($keluarga,200);
    }

    public function noKeluarga(Request $request)
    {
        $keluarga=Keluarga::select(DB::raw('substr(no_keluarga, -3) + 1 AS last_numb'))->where('sektor_id', $request->hint)->orderBy('no_keluarga', 'DESC')->first();
        $last_numb = $keluarga ? sprintf("%03d", $keluarga->last_numb) : '001';
        return Response::json($last_numb, 200);
    }
}