<?php

namespace App\Http\Controllers;

use App\Models\Martupol;
use App\Models\Keluarga;
use App\Models\Jemaat;
use App\Models\UcapanSyukur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Route;

class MartupolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $martupols = DB::table('martupol')
            ->select('martupol.*', 'mempelai.nama as nama_mempelai', 'pasangan_mempelai.nama as nama_pasangan_mempelai')
            ->leftJoin('jemaat as mempelai', 'mempelai.id', '=', 'martupol.mempelai')
            ->leftJoin('jemaat as pasangan_mempelai', 'pasangan_mempelai.id', '=', 'martupol.pasangan_mempelai')
            ->get()
        ;
        return view('transaksi.martupol.index', [
            'martupols' => $martupols,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.martupol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kepala_keluarga' => 'required',
            'keluarga_id' => 'required|exists:keluarga,id'
        ]);
        $martupol = Martupol::create($request->all());
        return redirect("/".$request->path()."/$martupol->id/edit")
            ->with('succeed', "Silahkan melanjutkan dengan mengisi data berikut atau delete untuk menghapus data");
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $martupol = Martupol::find($id);
        $keluarga = Keluarga::find($martupol->keluarga_id);
        $mempelai = Jemaat::find($martupol->mempelai);
        $pasangan_mempelai = Jemaat::find($martupol->pasangan_mempelai);
        $ucapanSyukur = $this->getUcapanSyukur($martupol);
        return view('transaksi.martupol.show', [
            'martupol' => $martupol,
            'keluarga' => $keluarga,
            'mempelai' => $mempelai,
            'pasangan_mempelai' => $pasangan_mempelai,
            'ucapanSyukur' => $ucapanSyukur
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $martupol = Martupol::find($id);
        $keluarga = Keluarga::find($martupol->keluarga_id);
        $detailKeluarga = DB::table('detail_keluarga')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->where('detail_keluarga.keluarga_id', '=', $keluarga->id)
            ->distinct()
            ->get()
        ;
        $ucapanSyukur = $this->getUcapanSyukur($martupol);


        //dd($ucapanSyukurs);
        $martupol->nama_pasangan_mempelai = ( $martupol->pasangan_mempelai ? Jemaat::find($martupol->pasangan_mempelai)->nama : '');
        return view('transaksi.martupol.edit',[
            'martupol' => $martupol,
            'keluarga' => $keluarga,
            'detailKeluargas' => $detailKeluarga,
            'ucapanSyukur' => $ucapanSyukur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\UpdateMartupolRequest $request, $id)
    {
        $route = strtok($request->path(), "/");

        $request->merge([
            'tanggal' => date("Y-m-d",strToTime($request['tanggal'])),
            'ucapan_syukur' => $martupol->ucapan_syukur ?? (string) Str::orderedUuid()
        ]);

        $martupol = martupol::find($id);
        $martupol->fill($request->all());
        $martupol->save();

        if(UcapanSyukur::where('ucapan_syukur_id', '=', $martupol->ucapan_syukur)->first()){
            $this->UpdateUcapanSyukur($request, $martupol, $route);
        } else {
            $this->saveUcapanSyukur($request, $martupol, $route);
        }

        return redirect("/$route/$martupol->id")
            ->with('succeed', "Data berhasil di update");
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $martupol = Martupol::find($id);
        UcapanSyukur::where('ucapan_syukur_id', '=', $martupol->ucapan_syukur)
            ->delete()
        ;
        $martupol->delete();
        return redirect("/martupol")
            ->with('succeed', "Data berhasil dihapus dari database");
        ;
    }

    private function getUcapanSyukur($martupol)
    {
        $route = strtok(Route::currentRouteName(), ".");
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $martupol->ucapan_syukur)->get();
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
    private function saveUcapanSyukur($request, $martupol, $route)
    {
        $jenisUcapanSyukur = ['gereja', 'majelis', 'pendeta', 'guru_huria', 'sintua_sektor', 'lain_lain'];
        $route == 'martupol' ? array_push($jenisUcapanSyukur, 'akte_nikah') : '';
        foreach($jenisUcapanSyukur as $ucapanSyukur)
        {
            UcapanSyukur::create([
                'ucapan_syukur_id' => $request->ucapan_syukur,
                'untuk' => $ucapanSyukur,
                'besaran' => $request['tk_'.$ucapanSyukur.'_paranak'] ?? 0,
                'dari_acara' => $route.'Paranak',
                'record' => $martupol->id,
                'tanggal' => $request->tanggal
            ]);

            UcapanSyukur::create([
                'ucapan_syukur_id' => $request->ucapan_syukur,
                'untuk' => $ucapanSyukur,
                'besaran' => $request['tk_'.$ucapanSyukur.'_parboru'] ?? 0,
                'dari_acara' => $route.'Parboru',
                'record' => $martupol->id,
                'tanggal' => $request->tanggal
            ]);
        }
    }

    private function updateUcapanSyukur($request, $martupol)
    {
        $jenisUcapanSyukur = ['gereja', 'majelis', 'pendeta', 'guru_huria', 'sintua_sektor', 'lain_lain'];
        $route == 'martupol' ? array_push($jenisUcapanSyukur, 'akte_nikah') : '';

        foreach($jenisUcapanSyukur as $ucapanSyukur)
        {
            UcapanSyukur::where('ucapan_syukur_id', '=', $martupol->ucapan_syukur)
                ->where('untuk', '=', $ucapanSyukur)
                ->where('dari_acara', '=', $route.'Paranak')
                ->first()
                ->update(['besaran' => $request['tk_'.$ucapanSyukur.'_paranak']])
            ;

            UcapanSyukur::where('ucapan_syukur_id', '=', $martupol->ucapan_syukur)
                ->where('untuk', '=', $ucapanSyukur)
                ->where('dari_acara', '=', $route.'martupolParboru')
                ->first()
                ->update(['besaran' => $request['tk_'.$ucapanSyukur.'_parboru']])
            ;
        }
    }

}
