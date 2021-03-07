<?php

namespace App\Http\Controllers;

use App\Models\JemaatBaru;
use App\Models\Jemaat;
use App\Models\Sektor;
use Illuminate\Http\Request;

class JemaatBaruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Jemaat $jemaat, Sektor $sektor)
    {
        return view('master.jemaatBaru.create', [
            'jemaat' => $jemaat,
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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JemaatBaru  $jemaatBaru
     * @return \Illuminate\Http\Response
     */
    public function show(JemaatBaru $jemaatBaru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JemaatBaru  $jemaatBaru
     * @return \Illuminate\Http\Response
     */
    public function edit(JemaatBaru $jemaatBaru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JemaatBaru  $jemaatBaru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JemaatBaru $jemaatBaru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JemaatBaru  $jemaatBaru
     * @return \Illuminate\Http\Response
     */
    public function destroy(JemaatBaru $jemaatBaru)
    {
        //
    }
}
