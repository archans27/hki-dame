<?php

namespace App\Http\Controllers;

use App\Models\Katekisasi;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Jemaat;

class KatekisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $filter = (object) [
        'search_year' => $request->input('search_year', ''),
    ];

    $query = DB::table('katekisasi')
        ->select('katekisasi.*', 'jemaat.nama', 'jemaat.tanggal_lahir', 'keluarga.alamat_rumah', 'keluarga.sektor_id')
        ->join('jemaat', 'jemaat.id', '=', 'katekisasi.jemaat_id')
        ->join('detail_keluarga', 'detail_keluarga.jemaat_id', '=', 'katekisasi.jemaat_id')
        ->join('keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
        ->distinct();

    if (Auth::user()->role != 'super') {
        $query->where('keluarga.sektor_id', '=', Auth::user()->sektor_id);
    }

    if ($filter->search_year) {
        $query->whereYear('katekisasi.created_at', $filter->search_year);
    }

    $katekisasi = $query->paginate(10);

    return view('transaksi.katekisasi.index', [
        'katekisasi' => $katekisasi,
        'filter' => $filter,
    ]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Katekisasi $katekisasi)
    {
        return view('transaksi.katekisasi.create',['katekisasi' => $katekisasi]);
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

        $katekisasi = new Katekisasi();
        $katekisasi = $katekisasi->fill($request->all());
        $katekisasi->save();
        $nama = $request->input('nama');

        return redirect('/katekisasi/'.$katekisasi->id)->with('succeed', "Data $nama sudah tersimpan ke database");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Katekisasi  $katekisasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Katekisasi::customGet($id);
        return view('transaksi.katekisasi.show', [
            'katekisasi' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Katekisasi  $katekisasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Katekisasi::customGet($id);
        return view('transaksi.katekisasi.edit', [
            'katekisasi' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Katekisasi  $katekisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['tanggal'] = date("Y-m-d",strToTime($request['tanggal']));
        $request->validate([
            'jemaat_id' => 'required|exists:jemaat,id',
        ]);

        $katekisasi = Katekisasi::find($id)->fill($request->all());
        $katekisasi->save();
        $nama = $request->input('nama');

        return redirect('/katekisasi/'.$id)->with('succeed', "Perubahan data dengan nama $nama sudah tersimpan ke database");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Katekisasi  $katekisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Katekisasi $katekisasi)
    {
        $katekisasi->delete();
        $jemaat = Jemaat::find($katekisasi->jemaat_id);
        return redirect('/katekisasi/')->with('succeed', "Data katekisasi dengan nama $jemaat->nama telah dihapus dari database");
    }
}
