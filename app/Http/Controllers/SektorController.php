<?php

namespace App\Http\Controllers;

use App\Models\Sektor;
use Illuminate\Http\Request;

class SektorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sektors = Sektor::orderBy('nama', 'asc')->get();
        return view('master.sektor.index', ['sektors' => $sektors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sektor = new Sektor();
        return view('master.sektor.create', ['sektor' => $sektor]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sektor = new Sektor();
        $request->validate([
            'nama' => 'required',
            'wilayah' => 'required',
        ]);
        $sektor->fill($request->all());
        $sektor->save();

        return redirect('/sektor/'.$sektor->id)->with('succeed', "Data $sektor->nama sudah tersimpan ke database");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sektor  $sektor
     * @return \Illuminate\Http\Response
     */
    public function show(Sektor $sektor)
    {
        return view('master.sektor.show', ['sektor' => $sektor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sektor  $sektor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sektor $sektor)
    {
        return view('master.sektor.edit', ['sektor' => $sektor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sektor  $sektor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sektor $sektor)
    {
        $request->validate([
            'nama' => 'required',
            'wilayah' => 'required',
        ]);

        $sektor->fill($request->all());
        $sektor->save();
        return redirect('/sektor/'.$sektor->id)->with('succeed', "Data $sektor->nama sudah tersimpan ke database");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sektor  $sektor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sektor $sektor)
    {
        $sektor->delete();
        return redirect('/sektor/')->with('succeed', "Data $sektor->nama sudah dihapus dari database");
    }
}
