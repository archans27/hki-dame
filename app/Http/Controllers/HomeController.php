<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Sektor;
use App\Models\DetailKeluarga;
use App\Models\Sintua;
use App\Models\JemaatBaru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\NoAnggotaNaposo;
use DB;
use DataTables;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('welcome');
    }


    public function getJemaats(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('jemaat')
                ->select('jemaat.*','sektor.nama as nama_sektor')
                ->where('jemaat.is_pindah', 0)->where('jemaat.hidup',1)
                ->join('detail_keluarga', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
                ->join('keluarga', 'detail_keluarga.keluarga_id', '=', 'keluarga.id')
                ->join('sektor', 'keluarga.sektor_id', '=', 'sektor.id')
            ;
            $data = $query->orderBy('jemaat.nama')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function($row){
                //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                //     return $actionBtn;
                // })
                // ->rawColumns(['action'])
                ->addColumn('tglLahir', function($row){
                    $tglLahir = date("d-m-Y",strToTime($row->tanggal_lahir));
                    return $tglLahir;
                })
                ->rawColumns(['tglLahir'])
                ->addColumn('namaSektor', function($row){
                    return $row->nama_sektor;
                })
                ->rawColumns(['namaSektor'])
                ->make(true);
        }
    }
}
