<?php

namespace App\Http\Controllers;

use App\Models\JemaatLahir;
use App\Models\JemaatBaru;
use App\Models\Jemaat;
use Illuminate\Http\Request;
use DB;

class JemaatLahirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JemaatBaru $jemaatBaru)
    {
        $jemaatBarus = DB::table('jemaat_baru')
            ->select('jemaat_baru.*', 'jemaat.*', 'jemaat_baru.id AS idJemaatBaru', )
            ->join('jemaat', 'jemaat.id', '=', 'jemaat_baru.jemaat_id')
            ->distinct()
            ->paginate(5)
        ;
        return view('transaksi.jemaatLahir.index', ['jemaatLahirs' => $jemaatBarus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Jemaat $jemaat)
    {
        return view('transaksi.jemaatLahir.create',['jemaat' => $jemaat,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jemaat_lahir  $jemaat_lahir
     * @return \Illuminate\Http\Response
     */
    public function show(jemaat_lahir $jemaat_lahir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jemaat_lahir  $jemaat_lahir
     * @return \Illuminate\Http\Response
     */
    public function edit(jemaat_lahir $jemaat_lahir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jemaat_lahir  $jemaat_lahir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jemaat_lahir $jemaat_lahir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jemaat_lahir  $jemaat_lahir
     * @return \Illuminate\Http\Response
     */
    public function destroy(jemaat_lahir $jemaat_lahir)
    {
        //
    }
}
