<?php

namespace App\Http\Controllers;

use App\Models\Meninggal;
use Illuminate\Http\Request;
use DB;
use App\Models\Jemaat;
use Illuminate\Support\Facades\Auth;

class MeninggalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meninggal = DB::table('meninggal')
            ->select('meninggal.*', 'jemaat.nama', 'jemaat.tanggal_lahir', 'keluarga.alamat_rumah')
            ->join('jemaat', 'jemaat.id', '=', 'meninggal.jemaat_id')
            ->join('detail_keluarga', 'detail_keluarga.jemaat_id', '=', 'meninggal.jemaat_id')
            ->join('keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->distinct()
            ->paginate(10)
        ;
        
        return view('transaksi.meninggal.index', [
            'meninggal' => $meninggal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Meninggal $meninggal)
    {
        return view('transaksi.meninggal.create',['meninggal' => $meninggal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['tanggal'] = date("Y-m-d",strToTime($request['tanggal']));
        $request->validate([
            'jemaat_id' => 'required|exists:jemaat,id',
        ]);

        if (Auth::user()->role != 'super') {
            $request['temporary'] = 0;
        }

        $meninggal = new Meninggal();
        $meninggal = $meninggal->fill($request->all());
        $meninggal->save();
        $jemaat = Jemaat::find($meninggal->jemaat_id);
        $jemaat->hidup = $request['temporary'];
        $jemaat->save();
        $nama = $request->input('nama');

        return redirect('/meninggal/'.$meninggal->id)->with('succeed', "Data $nama sudah tersimpan ke database");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meninggal  $meninggal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Meninggal::customGet($id);
        return view('transaksi.meninggal.show', [
            'meninggal' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meninggal  $meninggal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Meninggal::customGet($id);
        return view('transaksi.meninggal.edit', [
            'meninggal' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meninggal  $meninggal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['tanggal'] = date("Y-m-d",strToTime($request['tanggal']));
        $request->validate([
            'jemaat_id' => 'required|exists:jemaat,id',
        ]);

        $meninggal = Meninggal::find($id)->fill($request->all());
        $meninggal->save();
        $jemaat = Jemaat::find($meninggal->jemaat_id);
        $jemaat->hidup = $request['temporary'];
        $jemaat->save();
        $nama = $request->input('nama');

        return redirect('/meninggal/'.$id)->with('succeed', "Perubahan data dengan nama $nama sudah tersimpan ke database");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meninggal  $meninggal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meninggal $meninggal)
    {
        $meninggal->delete();
        $jemaat = Jemaat::find($meninggal->jemaat_id);
        $jemaat->hidup = 1;
        $jemaat->save();

        return redirect('/meninggal/')->with('succeed', "Data meninggal dengan nama $jemaat->nama telah dihapus dari database");
    }
}
