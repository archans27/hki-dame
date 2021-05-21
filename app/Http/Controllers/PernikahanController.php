<?php

namespace App\Http\Controllers;

use App\Models\Pernikahan;
use App\Models\Keluarga;
use App\Models\Jemaat;
use App\Models\UcapanSyukur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Route;

class PernikahanController extends Controller
{

    public function index(Request $request)
    {
        $route = $request->path();
        $jenis['jenis'] = $route == 'pernikahan' ? 'M' : 'IJ';
        $jenis['data'] = $route == 'pernikahan' ? 'Pemberkatan Pernikahan' : 'Ikat Janji';
        $jenis['uri'] = $route;
        $pernikahans = DB::table('pernikahan')
            ->select('pernikahan.*', 'mempelai.nama as nama_mempelai', 'pasangan_mempelai.nama as nama_pasangan_mempelai')
            ->leftJoin('jemaat as mempelai', 'mempelai.id', '=', 'pernikahan.mempelai')
            ->leftJoin('jemaat as pasangan_mempelai', 'pasangan_mempelai.id', '=', 'pernikahan.pasangan_mempelai')
            ->where('jenis', $jenis['jenis'])
            ->get()
        ;
        return view('transaksi.pernikahan.index', [
            'pernikahans' => $pernikahans,
            'jenis' => $jenis
        ]);
    }

    
    public function create()
    {
        $route = strtok(Route::currentRouteName(), ".");
        $jenis['jenis'] = $route == 'pernikahan' ? 'M' : 'IJ';
        $jenis['data'] = $route == 'pernikahan' ? 'Pemberkatan Pernikahan' : 'Ikat Janji';
        $jenis['uri'] = $route;
        return view('transaksi.pernikahan.create', ['jenis' => $jenis]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'kepala_keluarga' => 'required',
            'keluarga_id' => 'required|exists:keluarga,id'
        ]);
        $pernikahan = Pernikahan::create($request->all());
        return redirect("/".$request->path()."/$pernikahan->id/edit")
            ->with('succeed', "Silahkan melanjutkan dengan mengisi data berikut atau delete untuk menghapus data");
        ;
    }

    
    public function show($id)
    {
        $route = strtok(Route::currentRouteName(), ".");
        $jenis['jenis'] = $route == 'pernikahan' ? 'M' : 'IJ';
        $jenis['data'] = $route == 'pernikahan' ? 'Pemberkatan Pernikahan' : 'Ikat Janji';
        $jenis['uri'] = $route;

        $pernikahan = Pernikahan::find($id);
        $keluarga = Keluarga::find($pernikahan->keluarga_id);
        $mempelai = Jemaat::find($pernikahan->mempelai);
        $pasangan_mempelai = Jemaat::find($pernikahan->pasangan_mempelai);
        $ucapanSyukur = $this->getUcapanSyukur($pernikahan);
        return view('transaksi.pernikahan.show', [
            'pernikahan' => $pernikahan,
            'keluarga' => $keluarga,
            'mempelai' => $mempelai,
            'pasangan_mempelai' => $pasangan_mempelai,
            'ucapanSyukur' => $ucapanSyukur,
            'jenis' => $jenis
        ]);
    }

    
    public function edit($id)
    {
        $route = strtok(Route::currentRouteName(), ".");
        $jenis['jenis'] = $route == 'pernikahan' ? 'M' : 'IJ';
        $jenis['data'] = $route == 'pernikahan' ? 'Pemberkatan Pernikahan' : 'Ikat Janji';
        $jenis['uri'] = $route;

        $pernikahan = Pernikahan::find($id);
        $keluarga = Keluarga::find($pernikahan->keluarga_id);
        $detailKeluarga = DB::table('detail_keluarga')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->where('detail_keluarga.keluarga_id', '=', $keluarga->id)
            ->distinct()
            ->get()
        ;
        $ucapanSyukur = $this->getUcapanSyukur($pernikahan);

        //dd($ucapanSyukurs);
        $pernikahan->nama_pasangan_mempelai = ( $pernikahan->pasangan_mempelai ? Jemaat::find($pernikahan->pasangan_mempelai)->nama : '');
        return view('transaksi.pernikahan.edit',[
            'pernikahan' => $pernikahan,
            'keluarga' => $keluarga,
            'detailKeluargas' => $detailKeluarga,
            'ucapanSyukur' => $ucapanSyukur,
            'jenis' => $jenis
        ]);
    }

    
    public function update(\App\Http\Requests\UpdatePernikahanRequest $request, $id)
    {
        $route = strtok($request->path(), "/");

        $request->merge([
            'tanggal_pemberkatan' => date("Y-m-d",strToTime($request['tanggal_pemberkatan'])),
            'ucapan_syukur' => $pernikahan->ucapan_syukur ?? (string) Str::orderedUuid()
        ]);

        $pernikahan = Pernikahan::find($id);
        $pernikahan->fill($request->all());
        $pernikahan->save();

        if(UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)->first()){
            $this->UpdateUcapanSyukur($request, $pernikahan, $route);
        } else {
            $this->saveUcapanSyukur($request, $pernikahan, $route);
        }

        return redirect("/$route/$pernikahan->id")
            ->with('succeed', "Data berhasil di update");
        ;
    }

    
    public function destroy($id)
    {
        $route = strtok(Route::currentRouteName(), ".");
        $pernikahan = Pernikahan::find($id);
        UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->delete()
        ;
        $pernikahan->delete();
        return redirect("/".$route."/")
            ->with('succeed', "Data berhasil dihapus dari database");
        ;
    }

    private function getUcapanSyukur($pernikahan)
    {
        $route = strtok(Route::currentRouteName(), ".");
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)->get();
        $result = [];
        foreach ($ucapanSyukurs as $ucapanSyukur)
        {
            if($ucapanSyukur->dari_acara == $route."Paranak"){
                $result['paranak'][$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
            } else {
                $result['parboru'][$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
            }
        }
        return $result;
    }

    private function saveUcapanSyukur($request, $pernikahan, $route)
    {
        $jenisUcapanSyukur = ['gereja', 'majelis', 'pendeta', 'guru_huria', 'pembangunan'];
        foreach($jenisUcapanSyukur as $ucapanSyukur)
        {
            UcapanSyukur::create([
                'ucapan_syukur_id' => $request->ucapan_syukur,
                'untuk' => $ucapanSyukur,
                'besaran' => $request['tk_'.$ucapanSyukur.'_paranak'] ?? 0,
                'dari_acara' => $route.'Paranak',
                'record' => $pernikahan->id,
                'tanggal' => $request->tanggal_pemberkatan
            ]);

            UcapanSyukur::create([
                'ucapan_syukur_id' => $request->ucapan_syukur,
                'untuk' => $ucapanSyukur,
                'besaran' => $request['tk_'.$ucapanSyukur.'_parboru'] ?? 0,
                'dari_acara' => $route.'Parboru',
                'record' => $pernikahan->id,
                'tanggal' => $request->tanggal_pemberkatan
            ]);
        }
    }

    private function updateUcapanSyukur($request, $pernikahan)
    {
        $jenisUcapanSyukur = ['gereja', 'majelis', 'pendeta', 'guru_huria', 'pembangunan'];
        
        foreach($jenisUcapanSyukur as $ucapanSyukur)
        {
            UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
                ->where('untuk', '=', $ucapanSyukur)
                ->where('dari_acara', '=', $route.'Paranak')
                ->first()
                ->update(['besaran' => $request['tk_'.$ucapanSyukur.'_paranak']])
            ;

            UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
                ->where('untuk', '=', $ucapanSyukur)
                ->where('dari_acara', '=', $route.'pernikahanParboru')
                ->first()
                ->update(['besaran' => $request['tk_'.$ucapanSyukur.'_parboru']])
            ;
        }
    }
}
