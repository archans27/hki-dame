<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Sektor;
use App\Models\DetailKeluarga;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class JemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jemaats = Jemaat::all();
        return view('master.jemaat.index', ['jemaats' => $jemaats]);
    }


    public function create(Jemaat $jemaat, Sektor $sektor)
    {
        return view('master.jemaat.create', [
            'jemaat' => $jemaat,
            'sektors' => $sektor->all()
        ]);
    }

    public function store(\App\Http\Requests\StoreJemaatRequest $request)
    {
        $validated = $request->validated();
        $jemaat = Jemaat::create($request->all());
        $namaJemaat = $jemaat->refresh()->nama;
        
        return redirect('/jemaat/'.$jemaat->id)->with('succeed', "Jemaat dengan nama $namaJemaat sudah tersimpan ke database");
    }

    public function show(Request $request, Jemaat $jemaat)
    {
        return view('master.jemaat.show', ['jemaat' => $jemaat]);
    }

    public function edit(Jemaat $jemaat, Sektor $sektor)
    {
        return view('master.jemaat.edit', [
            'jemaat' => $jemaat,
            'sektors' => $sektor->all()
        ]);
    }

    public function update(\App\Http\Requests\StoreJemaatRequest $request, Jemaat $jemaat)
    {
        $validated = $request->validated();
        $jemaat->fill($request->all());
        $jemaat->save();

        return redirect('/jemaat/'.$jemaat->id)->with('succeed', "Jemaat dengan nama $jemaat->nama sudah tersimpan ke database");
    }

    public function destroy(Jemaat $jemaat, DetailKeluarga $detailKeluarga)
    {
        $detailKeluarga = DetailKeluarga::where('jemaat_id', '=', $jemaat->id)->first();
        $detailKeluarga->delete();
        $jemaat->delete();
        return redirect('/jemaat')->with('succeed', "Jemaat dengan nama $jemaat->nama sudah dihapus dari database");
    }
}
