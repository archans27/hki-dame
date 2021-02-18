<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\DetailKeluarga;
use Illuminate\Http\Request;
use DB;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluargas = Keluarga::all();
        return view('master.keluarga.index', ['keluargas' => $keluargas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.keluarga.create');
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
            'kepala_keluarga_id' => 'required|exists:jemaat,id',
            'kepala_keluarga' => 'required',
            'no_keluarga' => 'required',
            'sektor_id' => 'required',
            'alamat_rumah' => 'required',
        ]);
        
        $keluarga = Keluarga::create($request->all());
        $keluarga->save();
        $detailKeluarga = DetailKeluarga::findOrCreate($request->kepala_keluarga_id, 'jemaat_id');
        $detailKeluarga->keluarga_id = $keluarga->refresh()->id;
        $detailKeluarga->hubungan = $request->hubungan;
        $detailKeluarga->save();
        
        return redirect('/keluarga/'.$keluarga->id)->with('succeed', "Keluarga dengan kepala $keluarga->kepala_keluarga tersimpan ke database");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function show(Keluarga $keluarga)
    {
        $keluargas =  DB::table('keluarga')
            ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->join('jemaat', 'jemaat.id' , '=', 'detail_keluarga.jemaat_id')
            ->where('keluarga.id', '=', $keluarga->id)
            ->orderBy('jemaat.tanggal_lahir', 'asc')
            ->get();
        
        return view('master.keluarga.show', ['keluargas' => $keluargas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluarga $keluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keluarga $keluarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keluarga $keluarga)
    {
        //
    }
}
