<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\DetailKeluarga;
use App\Models\Jemaat;
use App\Models\Sektor;
use App\Enums\AnggotaKeluargaEnum;
use Illuminate\Http\Request;
use DB;
use PDF;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sector = $request->sector ?? null;
        $sector = $request->sector ?? false;
        $orderFrom = $request->order_from ?? 'kepala_keluarga';
        $orderBy = $request->order_by ?? 'asc';
        $search = $request->search ?? '';


        $request_pdf = (object)[
            "sector" => $sector,
            "search" => $search,
            "orderFrom" => $orderFrom,
            "orderBy" => $orderBy
        ];
        $request->session()->put('request_pdf_keluarga', $request_pdf);

        // Bangun kueri SQL
        $query = DB::table('keluarga')
            ->select('keluarga.id', 'keluarga.kepala_keluarga', 'keluarga.alamat_rumah as alamat_keluarga', 'sektor.nama as nama_sektor', 'jemaat.nama as nama_jemaat')
            ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->join('sektor', 'keluarga.sektor_id', '=', 'sektor.id')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->where('keluarga.is_pindah', 0);

        if ($search) {
            $query->where('jemaat.nama', 'like', "%$search%");
        }

        if ($sector) {
            $query->where('keluarga.sektor_id', '=', $sector); // Perbaikan disini, gunakan "keluarga.sektor_id" untuk pencarian berdasarkan sektor
        }

        $query->groupBy('keluarga.kepala_keluarga');

        $keluargas = $query->orderBy($orderFrom, $orderBy)->get();

        if ($request->has('exportpdf')) {
            // Jika permintaan PDF ada, maka buat objek PDF dan kirimkannya
            $pdf = PDF::loadView('master.keluarga.pdf', ['keluargas' => $keluargas]);
            return $pdf->download('Daftar_Keluarga.pdf');
        }

        return view('master.keluarga.index', ['keluargas' => $keluargas, 'filter' => $request]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sektor $sektor)
    {
        return view('master.keluarga.create', [
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
            'kepala_keluarga_id' => 'required|exists:jemaat,id',
            'kepala_keluarga' => 'required',
            'no_keluarga' => 'required',
            'sektor_id' => 'required',
            'alamat_rumah' => 'required',
            'status_rumah' => 'required',
        ]);

        $keluarga = Keluarga::create($request->all());
        $keluarga->save();
        $detailKeluarga = DetailKeluarga::where('jemaat_id', '=', $request->kepala_keluarga_id)->first();
        if(!isset($detailKeluarga)){
            $detailKeluarga = new DetailKeluarga();
            $detailKeluarga->jemaat_id = $request->kepala_keluarga_id;
        }
        $detailKeluarga->keluarga_id = $keluarga->refresh()->id;
        $detailKeluarga->hubungan = $request->hubungan;
        $detailKeluarga->save();
        $jemaat = Jemaat::where('id', '=', $detailKeluarga->jemaat_id)->first();
        switch (strtolower($request->hubungan)) {
            case AnggotaKeluargaEnum::suami():
                $jemaat->no_anggota = $request->no_keluarga.'001';
                break;
        }

        $jemaat->is_naposo = '0';
        $jemaat->save();

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
            ->select('keluarga.*', 'keluarga.alamat_rumah as alamat_keluarga' , 'detail_keluarga.*' , 'jemaat.*', 'sektor.nama as nama_sektor')
            ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->join('jemaat', 'jemaat.id' , '=', 'detail_keluarga.jemaat_id')
            ->join('sektor', 'keluarga.sektor_id' , '=', 'sektor.id')
            ->where('keluarga.id', '=', $keluarga->id)
            ->where('detail_keluarga.temporary', '=', false)
            ->orderBy('jemaat.tanggal_lahir', 'asc')
            ->get()
        ;

        return view('master.keluarga.show', ['keluargas' => $keluargas, 'keluarga_id' => $keluarga->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluarga $keluarga, Sektor $sektor)
    {
        $keluargas =  DB::table('keluarga')
            ->select('keluarga.*', 'keluarga.alamat_rumah as alamat_keluarga' , 'detail_keluarga.*' , 'jemaat.*', 'sektor.nama as nama_sektor')
            ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->join('jemaat', 'jemaat.id' , '=', 'detail_keluarga.jemaat_id')
            ->join('sektor', 'keluarga.sektor_id' , '=', 'sektor.id')
            ->where('keluarga.id', '=', $keluarga->id)
            ->where('detail_keluarga.temporary', '=', false)
            ->orderBy('jemaat.tanggal_lahir', 'asc')
            ->get()
        ;

        return view('master.keluarga.edit', [
            'keluargas' => $keluargas,
            'sektors' => $sektor->all(),
            'keluarga_id' => $keluarga->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keluarga $keluarga, DetailKeluarga $detailKeluarga)
    {
        //update kepala keluarga if not exist
        $kepalaKeluargaId = $request->kepala_keluarga_id;
        if (!count(DetailKeluarga::where('keluarga_id', '=', $keluarga->id)->where('jemaat_id', '=', $request->kepala_keluarga_id)->get())){
            $kepalaKeluarga = $keluarga->jemaat()
                ->where('keluarga_id', '=', $keluarga->id)
                ->orderBy('tanggal_lahir', 'ASC')
                ->first()
            ;
            $request->merge([
                'kepala_keluarga_id' => $kepalaKeluarga->pivot->jemaat_id,
                'kepala_keluarga' => $kepalaKeluarga->nama
            ]);
        }

        $request->validate([
            'kepala_keluarga_id' => 'required|exists:jemaat,id',
            'kepala_keluarga' => 'required',
            'no_keluarga' => 'required',
            'sektor_id' => 'required',
            'alamat_rumah' => 'required',
            'status_rumah' => 'required',
        ]);

        $keluarga->fill($request->all());
        $keluarga->save();

        return redirect('/keluarga/'.$keluarga->id)->with('succeed', "Data keluarga $request->kepala_keluarga sudah tersimpan ke database");

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

    public function gantiKepalaKeluarga(Request $request)
    {
        $jemaat = Jemaat::find($request->calon_kepala_keluarga_id);

        $keluarga = Keluarga::find($request->calon_keluarga_id);
        $keluarga->kepala_keluarga_id = $jemaat->id;
        $keluarga->kepala_keluarga = $jemaat->nama;
        $keluarga->save();
        return redirect()->back()->with('succeed', "Data kepala keluarga telah diubah menjadi $jemaat->nama ");
    }


    public function generatePDFKeluarga(Request $request)
    {
        $request_pdf = $request->session()->get('request_pdf_keluarga');
        $sector = $request_pdf->sector;
        $search = $request_pdf->search;
        $orderFrom = $request_pdf->orderFrom;
        $orderBy = $request_pdf->orderBy;

        $query = DB::table('keluarga')
            ->select('keluarga.id', 'keluarga.kepala_keluarga', 'keluarga.alamat_rumah as alamat_keluarga', 'sektor.nama as nama_sektor', 'jemaat.nama as nama_jemaat')
            ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->join('sektor', 'keluarga.sektor_id', '=', 'sektor.id')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->where('keluarga.is_pindah', 0);

        if ($search) {
            $query->where('jemaat.nama', 'like', "%$search");
        }

        if ($sector) {
            $query->where('keluarga.sektor_id', '=', $sector);
        }

        $query->groupBy('keluarga.kepala_keluarga');

        $keluargas = $query->orderBy($orderFrom, $orderBy)->get();

        $pdf = PDF::loadView('master.keluarga.pdfkeluarga', ['keluargas' => $keluargas, 'filter' => $request_pdf]);

        return $pdf->stream('Daftar Keluarga.pdf', ['Attachment' => 0]);
    }




}
