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
            'keluarga_id' => 'required|exists:keluarga,id',
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

    
    public function update(Request $request, Pernikahan $pernikahan)
    {
        $request['tanggal_pemberkatan'] = date("Y-m-d",strToTime($request['tanggal_pemberkatan']));
        if($pernikahan->ucapan_syukur){
            $this->UpdateUcapanSyukur($request, $pernikahan);
        } else {
            $pernikahan->ucapan_syukur = Str::orderedUuid();
            $this->saveUcapanSyukur($request, $pernikahan);
        }

        $pernikahan->fill($request->all());
        $pernikahan->save();

        return redirect("/pernikahan/$pernikahan->id")
        ->with('succeed', "Data berhasil di update");
    ;
    }

    
    public function destroy(Pernikahan $pernikahan)
    {
        //
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
        //paranak
        $tk_akte_nikah_paranak = new UcapanSyukur();
        $tk_akte_nikah_paranak->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_akte_nikah_paranak->untuk = "gereja";
        $tk_akte_nikah_paranak->besaran = $request['tk_akte_nikah_paranak'];
        $tk_akte_nikah_paranak->dari_acara = "pernikahanParanak";
        $tk_akte_nikah_paranak->record = $pernikahan->id;
        $tk_akte_nikah_paranak->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_akte_nikah_paranak->save();

        $tk_gereja_paranak = new UcapanSyukur();
        $tk_gereja_paranak->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_gereja_paranak->untuk = "gereja";
        $tk_gereja_paranak->besaran = $request['tk_gereja_paranak'];
        $tk_gereja_paranak->dari_acara = "pernikahanParanak";
        $tk_gereja_paranak->record = $pernikahan->id;
        $tk_gereja_paranak->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_gereja_paranak->save();
        
        $tk_majelis_paranak = new UcapanSyukur();
        $tk_majelis_paranak->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_majelis_paranak->untuk = "majelis";
        $tk_majelis_paranak->besaran = $request['tk_majelis_paranak'];
        $tk_majelis_paranak->dari_acara = "pernikahanParanak";
        $tk_majelis_paranak->record = $pernikahan->id;
        $tk_majelis_paranak->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_majelis_paranak->save();

        $tk_pendeta_paranak = new UcapanSyukur();
        $tk_pendeta_paranak->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_pendeta_paranak->untuk = "pendeta";
        $tk_pendeta_paranak->besaran = $request['tk_pendeta_paranak'];
        $tk_pendeta_paranak->dari_acara = "pernikahanParanak";
        $tk_pendeta_paranak->record = $pernikahan->id;
        $tk_pendeta_paranak->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_pendeta_paranak->save();

        $tk_guru_huria_paranak = new UcapanSyukur();
        $tk_guru_huria_paranak->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_guru_huria_paranak->untuk = "guru_huria";
        $tk_guru_huria_paranak->besaran = $request['tk_guru_huria_paranak'];
        $tk_guru_huria_paranak->dari_acara = "pernikahanParanak";
        $tk_guru_huria_paranak->record = $pernikahan->id;
        $tk_guru_huria_paranak->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_guru_huria_paranak->save();

        $tk_sintua_sektor_paranak = new UcapanSyukur();
        $tk_sintua_sektor_paranak->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_sintua_sektor_paranak->untuk = "sintua_sektor";
        $tk_sintua_sektor_paranak->besaran = $request['tk_sintua_sektor_paranak'];
        $tk_sintua_sektor_paranak->dari_acara = "pernikahanParanak";
        $tk_sintua_sektor_paranak->record = $pernikahan->id;
        $tk_sintua_sektor_paranak->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_sintua_sektor_paranak->save();

        $tk_lain_lain_paranak = new UcapanSyukur();
        $tk_lain_lain_paranak->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_lain_lain_paranak->untuk = "lain_lain";
        $tk_lain_lain_paranak->besaran = $request['tk_lain_lain_paranak'];
        $tk_lain_lain_paranak->dari_acara = "pernikahanParanak";
        $tk_lain_lain_paranak->record = $pernikahan->id;
        $tk_lain_lain_paranak->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_lain_lain_paranak->save();

        //paboru
        $tk_akte_nikah_paboru = new UcapanSyukur();
        $tk_akte_nikah_paboru->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_akte_nikah_paboru->untuk = "akte_nikah";
        $tk_akte_nikah_paboru->besaran = $request['tk_akte_nikah_paranak'];
        $tk_akte_nikah_paboru->dari_acara = "pernikahanPaboru";
        $tk_akte_nikah_paboru->record = $pernikahan->id;
        $tk_akte_nikah_paboru->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_akte_nikah_paboru->save();

        $tk_gereja_paboru = new UcapanSyukur();
        $tk_gereja_paboru->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_gereja_paboru->untuk = "gereja";
        $tk_gereja_paboru->besaran = $request['tk_gereja_paboru'];
        $tk_gereja_paboru->dari_acara = "pernikahanPaboru";
        $tk_gereja_paboru->record = $pernikahan->id;
        $tk_gereja_paboru->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_gereja_paboru->save();
        
        $tk_majelis_paboru = new UcapanSyukur();
        $tk_majelis_paboru->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_majelis_paboru->untuk = "majelis";
        $tk_majelis_paboru->besaran = $request['tk_majelis_paboru'];
        $tk_majelis_paboru->dari_acara = "pernikahanPaboru";
        $tk_majelis_paboru->record = $pernikahan->id;
        $tk_majelis_paboru->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_majelis_paboru->save();

        $tk_pendeta_paboru = new UcapanSyukur();
        $tk_pendeta_paboru->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_pendeta_paboru->untuk = "pendeta";
        $tk_pendeta_paboru->besaran = $request['tk_pendeta_paboru'];
        $tk_pendeta_paboru->dari_acara = "pernikahanPaboru";
        $tk_pendeta_paboru->record = $pernikahan->id;
        $tk_pendeta_paboru->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_pendeta_paboru->save();

        $tk_guru_huria_paboru = new UcapanSyukur();
        $tk_guru_huria_paboru->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_guru_huria_paboru->untuk = "guru_huria";
        $tk_guru_huria_paboru->besaran = $request['tk_guru_huria_paboru'];
        $tk_guru_huria_paboru->dari_acara = "pernikahanPaboru";
        $tk_guru_huria_paboru->record = $pernikahan->id;
        $tk_guru_huria_paboru->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_guru_huria_paboru->save();

        $tk_sintua_sektor_paboru = new UcapanSyukur();
        $tk_sintua_sektor_paboru->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_sintua_sektor_paboru->untuk = "sintua_sektor";
        $tk_sintua_sektor_paboru->besaran = $request['tk_sintua_sektor_paboru'];
        $tk_sintua_sektor_paboru->dari_acara = "pernikahanPaboru";
        $tk_sintua_sektor_paboru->record = $pernikahan->id;
        $tk_sintua_sektor_paboru->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_sintua_sektor_paboru->save();

        $tk_lain_lain_paboru = new UcapanSyukur();
        $tk_lain_lain_paboru->ucapan_syukur_id = $pernikahan->ucapan_syukur;
        $tk_lain_lain_paboru->untuk = "lain_lain";
        $tk_lain_lain_paboru->besaran = $request['tk_lain_lain_paboru'];
        $tk_lain_lain_paboru->dari_acara = "pernikahanPaboru";
        $tk_lain_lain_paboru->record = $pernikahan->id;
        $tk_lain_lain_paboru->tanggal = $pernikahan->tanggal_pemberkatan;
        $tk_lain_lain_paboru->save();
    }

    private function updateUcapanSyukur($request, $pernikahan)
    {
        //paranak
        $tk_akte_nikah_paranak = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'akte_nikah')
            ->where('dari_acara', '=', 'pernikahanParanak')
            ->first()
            ->update(['besaran' => $request['tk_akte_nikah_paranak']]);
        ;

        $tk_gereja_paranak = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'gereja')
            ->where('dari_acara', '=', 'pernikahanParanak')
            ->first()
            ->update(['besaran' => $request['tk_gereja_paranak']]);
        ;
        
        $tk_majelis_paranak = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'majelis')
            ->where('dari_acara', '=', 'pernikahanParanak')
            ->first()
            ->update(['besaran' => $request['tk_majelis_paranak']]);
        ;

        $tk_pendeta_paranak = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'pendeta')
            ->where('dari_acara', '=', 'pernikahanParanak')
            ->first()
            ->update(['besaran' => $request['tk_pendeta_paranak']]);
        ;

        $tk_guru_huria_paranak = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'guru_huria')
            ->where('dari_acara', '=', 'pernikahanParanak')
            ->first()
            ->update(['besaran' => $request['tk_guru_huria_paranak']]);
        ;

        $tk_sintua_sektor_paranak = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'sintua_sektor')
            ->where('dari_acara', '=', 'pernikahanParanak')
            ->first()
            ->update(['besaran' => $request['tk_sintua_sektor_paranak']]);
        ;

        $tk_lain_lain_paranak = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'lain_lain')
            ->where('dari_acara', '=', 'pernikahanParanak')
            ->first()
            ->update(['besaran' => $request['tk_lain_lain_paranak']]);
        ;

        //paboru
        $tk_akte_nikah_paboru = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'akte_nikah')
            ->where('dari_acara', '=', 'pernikahanPaboru')
            ->first()
            ->update(['besaran' => $request['tk_akte_nikah_paboru']]);
        ;

        $tk_gereja_paboru = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'gereja')
            ->where('dari_acara', '=', 'pernikahanPaboru')
            ->first()
            ->update(['besaran' => $request['tk_gereja_paboru']]);
        ;
        
        $tk_majelis_paboru = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'majelis')
            ->where('dari_acara', '=', 'pernikahanPaboru')
            ->first()
            ->update(['besaran' => $request['tk_majelis_paboru']]);
        ;

        $tk_pendeta_paboru = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'pendeta')
            ->where('dari_acara', '=', 'pernikahanPaboru')
            ->first()
            ->update(['besaran' => $request['tk_pendeta_paboru']]);
        ;

        $tk_guru_huria_paboru = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'guru_huria')
            ->where('dari_acara', '=', 'pernikahanPaboru')
            ->first()
            ->update(['besaran' => $request['tk_guru_huria_paboru']]);
        ;

        $tk_sintua_sektor_paboru = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'sintua_sektor')
            ->where('dari_acara', '=', 'pernikahanPaboru')
            ->first()
            ->update(['besaran' => $request['tk_sintua_sektor_paboru']]);
        ;

        $tk_lain_lain_paboru = UcapanSyukur::where('ucapan_syukur_id', '=', $pernikahan->ucapan_syukur)
            ->where('untuk', '=', 'lain_lain')
            ->where('dari_acara', '=', 'pernikahanPaboru')
            ->first()
            ->update(['besaran' => $request['tk_lain_lain_paboru']]);
        ;
    }
}
