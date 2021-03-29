<?php

namespace App\Http\Controllers;

use App\Models\Pernikahan;
use App\Models\Keluarga;
use App\Models\Jemaat;
use App\Models\UcapanSyukur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class PernikahanController extends Controller
{

    public function index(Request $request)
    {
        $pernikahans = DB::table('pernikahan')
            ->select('pernikahan.*', 'mempelai.nama as nama_mempelai', 'pasangan_mempelai.nama as nama_pasangan_mempelai')
            ->leftJoin('jemaat as mempelai', 'mempelai.id', '=', 'pernikahan.mempelai')
            ->leftJoin('jemaat as pasangan_mempelai', 'pasangan_mempelai.id', '=', 'pernikahan.pasangan_mempelai')
            ->get()
        ;
        return view('transaksi.pernikahan.index', [
            'pernikahans' => $pernikahans
        ]);
    }

    
    public function create()
    {
        return view('transaksi.pernikahan.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'kepala_keluarga' => 'required',
            'keluarga_id' => 'required|exists:keluarga,id'
        ]);
        $pernikahan = Pernikahan::create($request->all());
        return redirect("/pernikahan/$pernikahan->id/edit")
            ->with('succeed', "Silahkan melanjutkan dengan mengisi data berikut atau delete untuk menghapus data");
        ;
    }

    
    public function show(Pernikahan $pernikahan)
    {
        $keluarga = Keluarga::find($pernikahan->keluarga_id);
        $mempelai = Jemaat::find($pernikahan->mempelai);
        $pasangan_mempelai = Jemaat::find($pernikahan->pasangan_mempelai);
        $ucapanSyukur = $this->getUcapanSyukur($pernikahan);
        return view('transaksi.pernikahan.show', [
            'pernikahan' => $pernikahan,
            'keluarga' => $keluarga,
            'mempelai' => $mempelai,
            'pasangan_mempelai' => $pasangan_mempelai,
            'ucapanSyukur' => $ucapanSyukur
        ]);
    }

    
    public function edit(Pernikahan $pernikahan)
    {
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
            'ucapanSyukur' => $ucapanSyukur
        ]);
    }

    
    public function update(\App\Http\Requests\UpdatePernikahanRequest $request, Pernikahan $pernikahan)
    {
        $request->merge([
            'tanggal_pemberkatan' => date("Y-m-d",strToTime($request['tanggal_pemberkatan'])),
            'ucapan_syukur' => $pernikahan->ucapan_syukur ?? (string) Str::orderedUuid()
        ]);

        $pernikahan->fill($request->all());
        $pernikahan->save();

        if(UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)->first()){
            $this->UpdateUcapanSyukur($request, $pernikahan);
        } else {
            $this->saveUcapanSyukur($request, $pernikahan);
        }

        return redirect("/pernikahan/$pernikahan->id")
            ->with('succeed', "Data berhasil di update");
        ;
    }

    
    public function destroy(Pernikahan $pernikahan)
    {
        UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->delete()
        ;
        $pernikahan->delete();
        return redirect("/pernikahan/")
            ->with('succeed', "Data berhasil dihapus dari database");
        ;
    }

    private function getUcapanSyukur($pernikahan)
    {
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)->get();
        $result = [];
        foreach ($ucapanSyukurs as $ucapanSyukur)
        {
            if($ucapanSyukur->dari_acara == "pernikahanParanak"){
                $result['paranak'][$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
            } else {
                $result['paboru'][$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
            }
        }
        return $result;
    }

    private function saveUcapanSyukur($request, $pernikahan)
    {
        $jenisUcapanSyukur = ['akte_nikah', 'gereja', 'majelis', 'pendeta', 'guru_huria', 'sintua_sektor', 'lain_lain'];
        
        foreach($jenisUcapanSyukur as $ucapanSyukur)
        {
            UcapanSyukur::create([
                'ucapan_syukur_id' => $request->ucapan_syukur,
                'untuk' => $ucapanSyukur,
                'besaran' => $request['tk_'.$ucapanSyukur.'_paranak'] ?? 0,
                'dari_acara' => 'pernikahanParanak',
                'record' => $pernikahan->id,
                'tanggal' => $request->tanggal_pemberkatan
            ]);

            UcapanSyukur::create([
                'ucapan_syukur_id' => $request->ucapan_syukur,
                'untuk' => $ucapanSyukur,
                'besaran' => $request['tk_'.$ucapanSyukur.'_paboru'] ?? 0,
                'dari_acara' => 'pernikahanPaboru',
                'record' => $pernikahan->id,
                'tanggal' => $request->tanggal_pemberkatan
            ]);
        }
    }

    private function updateUcapanSyukur($request, $pernikahan)
    {
        $jenisUcapanSyukur = ['akte_nikah', 'gereja', 'majelis', 'pendeta', 'guru_huria', 'sintua_sektor', 'lain_lain'];

        foreach($jenisUcapanSyukur as $ucapanSyukur)
        {
            UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
                ->where('untuk', '=', $ucapanSyukur)
                ->where('dari_acara', '=', 'pernikahanParanak')
                ->first()
                ->update(['besaran' => $request['tk_'.$ucapanSyukur.'_paranak']])
            ;

            UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
                ->where('untuk', '=', $ucapanSyukur)
                ->where('dari_acara', '=', 'pernikahanPaboru')
                ->first()
                ->update(['besaran' => $request['tk_'.$ucapanSyukur.'_paboru']])
            ;
        }
    }
}
