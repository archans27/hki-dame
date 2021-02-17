<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
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


    public function create(Jemaat $jemaat)
    {
        return view('master.jemaat.create', ['jemaat' => $jemaat]);
    }

    public function store(\App\Http\Requests\StoreJemaatRequest $request)
    {
        $validated = $request->validated();
        $jemaat = new jemaat($validated);
        $jemaat->save();

        return view('master.jemaat.show', ['jemaat' => $jemaat]);
    }

    public function show(Request $request, Jemaat $jemaat)
    {
        return view('master.jemaat.show', ['jemaat' => $jemaat]);
    }

    public function edit(Jemaat $jemaat)
    {
        return view('master.jemaat.edit', ['jemaat' => $jemaat]);
    }

    public function update(\App\Http\Requests\StoreJemaatRequest $request, Jemaat $jemaat)
    {
        $validated = $request->validated();
        $jemaat->fill($validated);
        $jemaat->save();

        return redirect('/jemaat/'.$jemaat->id)->with('succeed', "Jemaat dengan nama $jemaat->nama sudah tersimpan ke database");
    }

    public function destroy(Jemaat $jemaat)
    {
        //$name = clone $jemaat->nama;
        $jemaat->delete();
        return redirect('/jemaat')->with('succeed', "Jemaat dengan nama $jemaat->nama sudah dihapus dari database");
    }
}
