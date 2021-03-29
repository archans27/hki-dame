<?php

namespace App\Http\Controllers;

use App\Models\BaptisSidi;
use App\Models\DetailBaptisSidi;
use App\Models\Keluarga;
use App\Models\DetailKeluarga;
use App\Models\Jemaat;
use App\Models\UcapanSyukur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class BaptisSidiController extends Controller
{

    
    public function index()
    {
        $baptisSidis = DB::table('baptis_sidi')
            ->select('baptis_sidi.*', 'keluarga.*', 'baptis_sidi.id as id')
            ->join('keluarga', 'keluarga.id', '=', 'baptis_sidi.keluarga_id')
            ->get()
        ;
        return view('transaksi.baptisSidi.index', [
            'baptisSidis' => $baptisSidis
        ]);
    }


    public function create()
    {
        return view('transaksi.baptisSidi.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'kepala_keluarga' => 'required',
            'keluarga_id' => 'required|exists:keluarga,id'
        ]);

        $baptisSidi = BaptisSidi::create($request->all());
        return redirect("/baptisSidi/$baptisSidi->id/edit")
            ->with('succeed', "Silahkan melanjutkan dengan mengisi data berikut atau delete untuk menghapus data");
        ;
    }

    
    public function show(BaptisSidi $baptisSidi)
    {
        $keluarga = Keluarga::find($baptisSidi->keluarga_id);
        $pesertas = DB::table('detail_baptis_sidi')
            ->join('jemaat', 'detail_baptis_sidi.jemaat_id', '=', 'jemaat.id')
            ->where('baptis_sidi_id', '=', $baptisSidi->id)
            ->get()
        ;
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $baptisSidi->ucapan_syukur)->get();
        $ucapanSyukurToArray = array();
        foreach($ucapanSyukurs as $ucapanSyukur)
        {
            $ucapanSyukurToArray[$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
        }
        //dd($baptisSidi);
        return view('transaksi.baptisSidi.show',[
            'baptisSidi' => $baptisSidi,
            'keluarga' => $keluarga,
            'pesertas' => $pesertas,
            'ucapanSyukur' => $ucapanSyukurToArray
        ]);
    }


    public function edit(BaptisSidi $baptisSidi)
    {
        $keluarga = Keluarga::find($baptisSidi->keluarga_id);
        $anggotaKeluargas = DB::table('detail_keluarga')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->where('detail_keluarga.keluarga_id', '=', $keluarga->id)
            ->get()
        ;
        $detailBaptisSidis = DetailBaptisSidi::where('baptis_sidi_id', '=', $baptisSidi->id)->get();
        $peserta = [];
        foreach($detailBaptisSidis as $detailBaptisSidi)
        {
            array_push($peserta, $detailBaptisSidi->jemaat_id);
        }
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $baptisSidi->ucapan_syukur)->get();
        //dd($ucapanSyukurs);
        $ucapanSyukurToArray = array();
        foreach($ucapanSyukurs as $ucapanSyukur)
        {
            $ucapanSyukurToArray[$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
        }
        //dd($ucapanSyukurToArray);
        return view('transaksi.baptisSidi.edit',[
            'baptisSidi' => $baptisSidi,
            'keluarga' => $keluarga,
            'anggotaKeluargas' => $anggotaKeluargas,
            'peserta' => $peserta,
            'ucapanSyukur' => $ucapanSyukurToArray
        ]);
    }


    public function update(Request $request, BaptisSidi $baptisSidi)
    {
        $request->validate([
            'peserta' => 'required',
            'tanggal' => 'required',
            'jenis' => 'required'
        ]);
        
        $this->saveDetailTransaction($request->peserta, $baptisSidi);
        $ucapanSyukurId = $this->saveUcpanSyukur($request, $baptisSidi);
        $request->merge([
            'ucapan_syukur' => $ucapanSyukurId,
            'tanggal' => date("Y-m-d",strToTime($request['tanggal']))
        ]);
        $baptisSidi->fill($request->all())->save();
        return redirect("/baptisSidi/$baptisSidi->id/")
            ->with('succeed', "Data berhasil diperbaharui");
        ;
    }

    
    public function destroy(BaptisSidi $baptisSidi)
    {
        UcapanSyukur::where('dari_acara', '=', 'baptis_sidi')
            ->where('record', '=', $baptisSidi->id)
            ->delete()
        ;
        DetailBaptisSidi::where('baptis_sidi_id', '=', $baptisSidi->id)
            ->delete()
        ;
        $baptisSidi->delete();
        return redirect("/baptisSidi/")
            ->with('succeed', "Data berhasil dihapus dari database");
        ;
    }


    private function saveDetailTransaction($pesertas, $baptisSidi)
    {
        DetailBaptisSidi::where('baptis_sidi_id', '=', $baptisSidi->id)->delete();
        foreach($pesertas as $peserta)
        {
            DetailBaptisSidi::create([
                'baptis_sidi_id' => $baptisSidi->id,
                'jemaat_id' => $peserta
            ]);
        }
    }


    private function saveUcpanSyukur($request, $baptisSidi)
    {
        if($baptisSidi->ucapan_syukur){
            UcapanSyukur::where('ucapan_syukur_id', '=', $baptisSidi->ucapan_syukur)->delete();
        }

        $jenisUcapanSyukur =  ['gereja', 'pendeta', 'majelis', 'guru_huria', 'lain_lain', 'akte'];
        if ($request->jenis == 'Sidi'){
            array_push($jenisUcapanSyukur, 'tim_pengajar');
        }

        $ucapanSyukurId = (string) Str::uuid();

        foreach ($jenisUcapanSyukur as $untuk){
            $uc = new UcapanSyukur();
            $uc->ucapan_syukur_id = $ucapanSyukurId;
            $uc->untuk = $untuk;
            $uc->besaran = $request['tk_'.$untuk] ?? 0;
            $uc->dari_acara = 'baptis_sidi';
            $uc->record = $baptisSidi->id;
            $uc->tanggal = $request['tanggal'];
            $uc->save();
        }

        return $ucapanSyukurId;
    }
}
