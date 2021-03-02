<?php

namespace App\Http\Controllers;

use App\Models\Sintua;
use App\Models\Sektor;
use Illuminate\Http\Request;
use DB;

class SintuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sintuas = Sintua::customGet();
        return view('master.sintua.index', ['sintuas' => $sintuas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Sektor $sektor)
    {
        return view('master.sintua.create', [
            'sektors' => $sektor->all()
        ]);
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
            'jemaat_id' => 'required|exists:jemaat,id',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sintua  $sintua
     * @return \Illuminate\Http\Response
     */
    public function show(Sintua $sintua)
    {
        $sintua = $sintua->customGet($sintua->id);
        return view('master.sintua.show', ['sintua' => $sintua]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sintua  $sintua
     * @return \Illuminate\Http\Response
     */
    public function edit(Sintua $sintua)
    {
        $sintua = $sintua->customGet($sintua->id);
        return view('master.sintua.edit', ['sintua' => $sintua]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sintua  $sintua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sintua $sintua)
    {
        $request->validate([
            'jemaat_id' => 'required|exists:jemaat,id',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sintua  $sintua
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sintua $sintua)
    {
        //
    }
}
