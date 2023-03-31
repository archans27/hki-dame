<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Sektor;
use App\Models\DetailKeluarga;
use App\Models\Sintua;
use App\Models\JemaatBaru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\NoAnggotaNaposo;
use DB;
use PDF;

class JemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $month = $request->month ?? false;
        $year = $request->year ?? false;
        $golongan_darah = $request->golongan_darah ?? false;
        $search = $request->search ?? '';
        $orderFrom = $request->order_from ?? 'nama';
        $orderFrom = $request->order_from == 'hari_lahir' ? DB::raw('strftime("%d", "tanggal_lahir")') : $orderFrom;
        $orderBy = $request->order_by ?? 'asc';

        $request_excel = (object)[
            "month" => $month,
            "year" => $year,
            "golongan_darah" => $golongan_darah,
            "search" => $search,
            "orderFrom" => $orderFrom,
            "orderBy" => $orderBy
        ];
        $request->session()->put('request_excel_jemaat', $request_excel);

        $query = Jemaat::where('is_pindah', 0)->where('hidup',1)->where('nama', 'like', "%$search%");
        if($year){$query->whereYear('tanggal_lahir', '=', $year);}
        if($month){$query->whereMonth('tanggal_lahir', '=', $month);}
        if($golongan_darah){$query->where('golongan_darah', '=', $golongan_darah);}
        $jemaats = $query->orderBy($orderFrom, $orderBy)->paginate(20)->appends($request->all());
        return view('master.jemaat.index', ['jemaats' => $jemaats, 'filter' => $request]);
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
        $request['tanggal_lahir'] = date("Y-m-d",strToTime($request['tanggal_lahir']));
        $request['tanggal_anggota'] = date("Y-m-d",strToTime($request['tanggal_anggota']));
        $request['is_naposo'] = $request['is_naposo'] ? 1 : 0;

        $jemaat = Jemaat::create($request->all());
        $jemaat->save();
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
        $request['tanggal_lahir'] = date("Y-m-d",strToTime($request['tanggal_lahir']));
        $request['tanggal_anggota'] = date("Y-m-d",strToTime($request['tanggal_anggota']));

        $jemaat->fill($request->all());
        $jemaat->save();

        return redirect('/jemaat/'.$jemaat->id)->with('succeed', "Jemaat dengan nama $jemaat->nama sudah tersimpan ke database");
    }

    public function destroy(Jemaat $jemaat)
    {
        DetailKeluarga::where('jemaat_id', '=', $jemaat->id)->delete();
        Sintua::where('jemaat_id', '=', $jemaat->id)->delete();
        JemaatBaru::where('jemaat_id', '=', $jemaat->id)->delete();
        $jemaat->delete();
        return redirect('/jemaat')->with('succeed', "Jemaat dengan nama $jemaat->nama sudah dihapus dari database");
    }

    public function generatePDF(Request $request)
    {
        $request_excel = $request->session()->get('request_excel_jemaat');
        $month = $request_excel->month;
        $year = $request_excel->year;
        $golongan_darah = $request_excel->golongan_darah;
        $search = $request_excel->search;
        $orderFrom = $request_excel->orderFrom;
        $orderBy = $request_excel->orderBy;

        $query = Jemaat::where('is_pindah', 0)->where('hidup',1)->where('nama', 'like', "%$search%");
        if($year){$query->whereYear('tanggal_lahir', '=', $year);}
        if($month){$query->whereMonth('tanggal_lahir', '=', $month);}
        if($golongan_darah){$query->where('golongan_darah', '=', $golongan_darah);}
        $jemaats = $query->orderBy($orderFrom, $orderBy)->get();
        $pdf = PDF::loadView('master.jemaat.pdf', ['jemaats' => $jemaats, 'filter' => $request_excel]);
    
        $request->session()->forget('request_excel_jemaat');
        return $pdf->stream('Daftar Jemaat.pdf',array('Attachment'=>0));
    }
}
