<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKeluarga;

class DetailKeluargaController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detailKeluarga = DetailKeluarga::where('jemaat_id', '=', $request->jemaat_id)->first();
        if(!isset($detailKeluarga)){
            $detailKeluarga = new DetailKeluarga();
            $detailKeluarga->jemaat_id = $request->jemaat_id;
        }
        $detailKeluarga->keluarga_id = $request->keluarga_id;
        $detailKeluarga->hubungan = $request->hubungan;
        $detailKeluarga->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailKeluarga = DetailKeluarga::where('jemaat_id', '=', $id)->first();
        $detailKeluarga->delete();
        return redirect()->back();
    }
}
