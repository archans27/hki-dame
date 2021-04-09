<?php

namespace App\Http\Controllers;

use App\Models\Pindah;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailKeluarga;
use App\Models\Jemaat;

class PindahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pindahs = DB::table('pindah')
            ->select('pindah.*', 'keluarga.*', 'pindah.id as id')
            ->join('keluarga', 'keluarga.id', '=', 'pindah.keluarga_id')
            ->get()
        ;
        return view('transaksi.pindah.index', [
            'pindahs' => $pindahs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.pindah.create');
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

        if (Auth::user()->role != 'super') {
            $request['temporary'] = 0;
        }

        $pindah = Pindah::create($request->all());
        return redirect("/pindah/$pindah->id/edit")
            ->with('succeed', "Silahkan melanjutkan dengan mengisi data berikut.");
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pindah  $pindah
     * @return \Illuminate\Http\Response
     */
    public function show(Pindah $pindah)
    {
        $keluarga = Keluarga::find($pindah->keluarga_id);
        $anggotaKeluargas = DB::table('detail_keluarga')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->where('detail_keluarga.keluarga_id', '=', $keluarga->id)
            ->get()
        ;

        return view('transaksi.pindah.show',[
            'pindah' => $pindah,
            'keluarga' => $keluarga,
            'anggotaKeluargas' => $anggotaKeluargas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pindah  $pindah
     * @return \Illuminate\Http\Response
     */
    public function edit(Pindah $pindah)
    {
        $keluarga = Keluarga::find($pindah->keluarga_id);
        $anggotaKeluargas = DB::table('detail_keluarga')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->where('detail_keluarga.keluarga_id', '=', $keluarga->id)
            ->get()
        ;

        return view('transaksi.pindah.edit',[
            'pindah' => $pindah,
            'keluarga' => $keluarga,
            'anggotaKeluargas' => $anggotaKeluargas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pindah  $pindah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pindah $pindah)
    {
        $request->validate([
            'tempat' => 'required'
        ]);

        $pindah->fill($request->all())->save();

        $keluarga = Keluarga::find($pindah->keluarga_id);
        $keluarga->is_pindah = $request->input('temporary') ? 0 : 1;
        $keluarga->save();

        $DetailKeluarga = DetailKeluarga::where('keluarga_id', $keluarga->id)->get();
        foreach ($DetailKeluarga as $data) {
            $jemaat = Jemaat::find($data->jemaat_id);
            $jemaat->is_pindah = $request->input('temporary') ? 0 : 1;
            $jemaat->save();
        }
        return redirect("/pindah/$pindah->id/")
            ->with('succeed', "Data berhasil diperbaharui");
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pindah  $pindah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pindah $pindah)
    {
        $pindah->delete();
        $keluarga = Keluarga::find($pindah->keluarga_id);
        $keluarga->is_pindah = 0;
        $keluarga->save();

        $DetailKeluarga = DetailKeluarga::where('keluarga_id', $keluarga->id)->get();
        foreach ($DetailKeluarga as $data) {
            $jemaat = Jemaat::find($data->jemaat_id);
            $jemaat->is_pindah = 0;
            $jemaat->save();
        }
        return redirect("/pindah/")
            ->with('succeed', "Data berhasil dihapus dari database");
        ;
    }
}
