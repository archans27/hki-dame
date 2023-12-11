<?php

namespace App\Http\Controllers;

use App\Models\JemaatLahir;
use App\Models\Jemaat;
use App\Models\DetailKeluarga;
use App\Models\UcapanSyukur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;

class JemaatLahirController extends Controller
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

        $jemaatLahirs = DB::table('jemaat_lahir')
            ->select('jemaat.*', 'keluarga.kepala_keluarga AS nama_kepala_keluarga', 'jemaat_lahir.id as idJemaatLahir', 'keluarga.sektor_id')
            ->join('detail_keluarga', 'detail_keluarga.id', '=', 'jemaat_lahir.detail_keluarga_id')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->join('keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->distinct();

        if (Auth::user()->role != 'super') {
            $jemaatLahirs->where('keluarga.sektor_id', '=', Auth::user()->sektor_id);
        }

        if ($filter->search_year) {
            $jemaatLahirs->whereYear('jemaat_lahir.created_at', $filter->search_year);
        }

        $jemaatLahirs = $jemaatLahirs->paginate(10);

        return view('transaksi.jemaatLahir.index', ['jemaatLahirs' => $jemaatLahirs, 'filter' => $filter]);
    }

    public function create(Jemaat $jemaat)
    {
        return view('transaksi.jemaatLahir.create',['jemaat' => $jemaat]);
    }

    public function store(\App\Http\Requests\StoreJemaatLahirRequest $request, Jemaat $jemaat)
    {
        $request['tanggal_lahir'] = date("Y-m-d",strToTime($request['tanggal_lahir']));
        if (Auth::user()->role != 'super') {
            $request['temporary'] = true;
        }
        $ucapanSyukurId = (string) Str::orderedUuid();
        $jemaat = Jemaat::create($request->all());
        $detailKeluarga = DetailKeluarga::create([
            'keluarga_id' => $request->keluarga_api,
            'jemaat_id' => $jemaat->id,
            'hubungan' => 'Anak',
            'temporary' => $request['temporary']
        ]);
        $jemaatLahir = JemaatLahir::create([
            'jam_lahir' => $request['jam_lahir'],
            'detail_keluarga_id' => $detailKeluarga->id,
            'status_anak' => $request['status_anak'],
            'ucapan_syukur_id' => $ucapanSyukurId
        ]);

        $tk_gereja = new UcapanSyukur();
        $tk_gereja->ucapan_syukur_id = $ucapanSyukurId;
        $tk_gereja->untuk = "gereja";
        $tk_gereja->besaran = $request['tk_gereja'];
        $tk_gereja->dari_acara = "jemaatLahir";
        $tk_gereja->record = $jemaatLahir->id;
        $tk_gereja->tanggal = $jemaatLahir->created_at;
        $tk_gereja->save();
        $tk_majelis = new UcapanSyukur();
        $tk_majelis->ucapan_syukur_id = $ucapanSyukurId;
        $tk_majelis->untuk = "majelis";
        $tk_majelis->besaran = $request['tk_majelis'];
        $tk_majelis->dari_acara = "jemaatLahir";
        $tk_majelis->record = $jemaatLahir->id;
        $tk_majelis->tanggal = $jemaatLahir->created_at;
        $tk_majelis->save();
        $tk_pendeta = new UcapanSyukur();
        $tk_pendeta->ucapan_syukur_id = $ucapanSyukurId;
        $tk_pendeta->untuk = "pendeta";
        $tk_pendeta->besaran = $request['tk_pendeta'];
        $tk_pendeta->dari_acara = "jemaatLahir";
        $tk_pendeta->record = $jemaatLahir->id;
        $tk_pendeta->tanggal = $jemaatLahir->created_at;
        $tk_pendeta->save();
        $tk_guru_huria = new UcapanSyukur();
        $tk_guru_huria->ucapan_syukur_id = $ucapanSyukurId;
        $tk_guru_huria->untuk = "guru_huria";
        $tk_guru_huria->besaran = $request['tk_guru_huria'];
        $tk_guru_huria->dari_acara = "jemaatLahir";
        $tk_guru_huria->record = $jemaatLahir->id;
        $tk_guru_huria->tanggal = $jemaatLahir->created_at;
        $tk_guru_huria->save();
        $tk_pembangunan = new UcapanSyukur();
        $tk_pembangunan->ucapan_syukur_id = $ucapanSyukurId;
        $tk_pembangunan->untuk = "pembangunan";
        $tk_pembangunan->besaran = $request['tk_pembangunan'];
        $tk_pembangunan->dari_acara = "jemaatLahir";
        $tk_pembangunan->record = $jemaatLahir->id;
        $tk_pembangunan->tanggal = $jemaatLahir->created_at;
        $tk_pembangunan->save();
        return redirect('/jemaatLahir/')
            ->with('succeed', "Anak dengan nama ".$jemaat->nama." sudah tersimpan ke database")
        ;
    }

    public function show(JemaatLahir $jemaatLahir)
    {
        $jemaatLahir = DB::table('jemaat_lahir')
            ->select('jemaat.*', 'keluarga.*', 'jemaat_lahir.id as idJemaatLahir', 'jemaat_lahir.*')
            ->join('detail_keluarga', 'detail_keluarga.id', '=', 'jemaat_lahir.detail_keluarga_id')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->join('keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->first()
        ;
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $jemaatLahir->ucapan_syukur_id)->get();
        foreach($ucapanSyukurs as $ucapanSyukur)
        {
            $ucapanSyukurToArray[$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
        }

        return view('transaksi.jemaatLahir.show', [
            'jemaatLahir' => $jemaatLahir,
            'ucapanSyukur' => $ucapanSyukurToArray
        ]);
    }

    public function edit(JemaatLahir $jemaatLahir)
    {
        $jemaatLahir = DB::table('jemaat_lahir')
            ->select('jemaat.*', 'keluarga.*', 'jemaat_lahir.id as idJemaatLahir', 'jemaat_lahir.*')
            ->join('detail_keluarga', 'detail_keluarga.id', '=', 'jemaat_lahir.detail_keluarga_id')
            ->join('jemaat', 'jemaat.id', '=', 'detail_keluarga.jemaat_id')
            ->join('keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->first()
        ;
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $jemaatLahir->ucapan_syukur_id)->get();
        foreach($ucapanSyukurs as $ucapanSyukur)
        {
            $ucapanSyukurToArray[$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
        }

        return view('transaksi.jemaatLahir.edit', [
            'jemaat' => $jemaatLahir,
            'ucapanSyukur' => $ucapanSyukurToArray
        ]);
    }

    public function update(Request $request, JemaatLahir $jemaatLahir)
    {
        $request['tanggal_lahir'] = date("Y-m-d",strToTime($request['tanggal_lahir']));
        $detailKeluarga = DetailKeluarga::withoutGlobalScope('temporary')->find($jemaatLahir->detail_keluarga_id);
        $jemaat = Jemaat::withoutGlobalScope('temporary')->find($detailKeluarga->jemaat_id);

        $jemaat->fill($request->all());
        $jemaat->save();
        $detailKeluarga->fill([
            'temporary' => $request['temporary']
        ]);
        $detailKeluarga->save();
        $jemaatLahir->fill([
            'status_anak' => $request['status_anak'],
            'jam_lahir' => $request['jam_lahir']
        ]);
        $jemaatLahir->save();

        $tk_gereja = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatLahir->ucapan_syukur_id)
            ->where('untuk', '=', 'gereja')
            ->first()
        ;
        $tk_gereja->besaran = $request['tk_gereja'];
        $tk_gereja->save();
        $tk_majelis = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatLahir->ucapan_syukur_id)
            ->where('untuk', '=', 'majelis')
            ->first()
        ;
        $tk_majelis->besaran = $request['tk_majelis'];
        $tk_majelis->save();
        $tk_pendeta = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatLahir->ucapan_syukur_id)
            ->where('untuk', '=', 'pendeta')
            ->first()
        ;
        $tk_pendeta->besaran = $request['tk_pendeta'];
        $tk_pendeta->save();
        $tk_guru_huria = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatLahir->ucapan_syukur_id)
            ->where('untuk', '=', 'guru_huria')
            ->first()
        ;
        $tk_guru_huria->besaran = $request['tk_guru_huria'];
        $tk_guru_huria->save();
        $tk_pembangunan = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatLahir->ucapan_syukur_id)
            ->where('untuk', '=', 'pembangunan')
            ->first()
        ;
        $tk_pembangunan->besaran = $request['tk_pembangunan'];
        $tk_pembangunan->save();

        return redirect("/jemaatLahir/$jemaatLahir->id")
            ->with('succeed', "Perubahan data jemaat dengan nama ".$jemaat->nama." sudah tersimpan ke database")
        ;

    }

    public function destroy(JemaatLahir $jemaatLahir)
    {
        $jemaatLahir->delete();
        UcapanSyukur::where('ucapan_syukur_id','=',$jemaatLahir->ucapan_syukur_id)->delete();
        $detailKeluarga = DetailKeluarga::withoutGlobalScope('temporary')->where('id', '=', $jemaatLahir->detail_keluarga_id);
        $jemaat = Jemaat::withoutGlobalScope('temporary')->find($detailKeluarga->first()->jemaat_id);

        $nama = $jemaat->nama;
        $detailKeluarga->delete();
        $jemaat->delete();

        return redirect('/jemaatLahir/')
            ->with('succeed', "Jemaat dengan nama ".$nama." telah dihapus dari database")
    ;
    }
}
