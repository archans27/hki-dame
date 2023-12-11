<?php

namespace App\Http\Controllers;

use App\Models\JemaatBaru;
use App\Models\Jemaat;
use App\Models\Sektor;
use App\Models\UcapanSyukur;
use App\Models\DetailKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;


class JemaatBaruController extends Controller
{

    public function index(JemaatBaru $jemaatBaru, Request $request)
{
    $filter = (object) [
        'search_year' => $request->input('search_year', ''),
    ];

    $jemaatBarus = DB::table('jemaat_baru')
        ->select('jemaat_baru.*', 'jemaat.*', 'jemaat_baru.id AS idJemaatBaru', 'keluarga.sektor_id' )
        ->join('jemaat', 'jemaat.id', '=', 'jemaat_baru.jemaat_id')
        ->leftJoin('detail_keluarga', 'detail_keluarga.jemaat_id', '=', 'jemaat.id')
        ->leftJoin('keluarga', 'detail_keluarga.keluarga_id', '=', 'keluarga.id')
        ->distinct()
        ->get();

    if ($filter->search_year) {
        $jemaatBarus = $jemaatBarus->filter(function ($item) use ($filter) {
            return isset($item->tanggal) && date('Y', strtotime($item->tanggal)) == $filter->search_year;
        });
    }

    // Convert the filtered results to a LengthAwarePaginator
    $perPage = 5;
    $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
    $currentPageItems = array_slice($jemaatBarus->toArray(), ($currentPage - 1) * $perPage, $perPage);
    $jemaatBarus = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentPageItems,
        count($jemaatBarus),
        $perPage,
        $currentPage,
        ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
    );

    return view('transaksi.jemaatBaru.index', ['jemaatBarus' => $jemaatBarus, 'filter' => $filter]);
}







    public function create(Jemaat $jemaat, Sektor $sektor)
    {
        return view('transaksi.jemaatBaru.create', [
            'jemaat' => $jemaat,
            'sektors' => $sektor->all()
        ]);
    }


    public function store(\App\Http\Requests\StoreJemaatBaruRequest $request)
    {
        //dd($lampiran);
        $request['tanggal_lahir'] = date("Y-m-d",strToTime($request['tanggal_lahir']));
        $request['tanggal_anggota'] = date("Y-m-d",strToTime($request['tanggal_anggota']));

        $uuid = array(
            'jemaatBaruId' => (string) Str::orderedUuid(),
            'ucapanSyukurId' => (string) Str::orderedUuid(),
        );
        if (Auth::user()->role != 'super') {
            $request['temporary'] = true;
        }

        $jemaat = new Jemaat();
        $jemaat = $jemaat->fill($request->all());
        $jemaat->save();

        /**
         * One line official Laravel style
         */
        // $ucapanSyukur = UcapanSyukur::create([
        //     "id" => $uuid['ucapanSyukurId'],
        //     "acara" => 'jemaatBaru',
        //     "record" => $uuid['jemaatBaruId'],
        //     "tk_gereja" => $validated['tk_gereja'],
        //     "tk_pendeta" => $validated['tk_pendeta'],
        //     "tk_majelis" => $validated['tk_majelis'],
        //     "tk_guru_huria" => $validated['tk_guru_huria'],
        //     "tk_pembangunan" => $validated['tk_pembangunan'],
        //     "tanggal" => $validated['tanggal_anggota']
        // ]);

        //TODO Project Lead want (array style)
        $tk_gereja = new UcapanSyukur();
        $tk_gereja->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_gereja->untuk = "gereja";
        $tk_gereja->besaran = $request['tk_gereja'];
        $tk_gereja->dari_acara = "jemaatBaru";
        $tk_gereja->record = $uuid['jemaatBaruId'];
        $tk_gereja->tanggal = $request['tanggal_anggota'];
        $tk_gereja->save();
        $tk_majelis = new UcapanSyukur();
        $tk_majelis->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_majelis->untuk = "majelis";
        $tk_majelis->besaran = $request['tk_majelis'];
        $tk_majelis->dari_acara = "jemaatBaru";
        $tk_majelis->record = $uuid['jemaatBaruId'];
        $tk_majelis->tanggal = $request['tanggal_anggota'];
        $tk_majelis->save();
        $tk_pendeta = new UcapanSyukur();
        $tk_pendeta->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_pendeta->untuk = "pendeta";
        $tk_pendeta->besaran = $request['tk_pendeta'];
        $tk_pendeta->dari_acara = "jemaatBaru";
        $tk_pendeta->record = $uuid['jemaatBaruId'];
        $tk_pendeta->tanggal = $request['tanggal_anggota'];
        $tk_pendeta->save();
        $tk_guru_huria = new UcapanSyukur();
        $tk_guru_huria->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_guru_huria->untuk = "guru_huria";
        $tk_guru_huria->besaran = $request['tk_guru_huria'];
        $tk_guru_huria->dari_acara = "jemaatBaru";
        $tk_guru_huria->record = $uuid['jemaatBaruId'];
        $tk_guru_huria->tanggal = $request['tanggal_anggota'];
        $tk_guru_huria->save();
        $tk_pembangunan = new UcapanSyukur();
        $tk_pembangunan->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_pembangunan->untuk = "pembangunan";
        $tk_pembangunan->besaran = $request['tk_pembangunan'];
        $tk_pembangunan->dari_acara = "jemaatBaru";
        $tk_pembangunan->record = $uuid['jemaatBaruId'];
        $tk_pembangunan->tanggal = $request['tanggal_anggota'];
        $tk_pembangunan->save();



        $jemaatBaru = JemaatBaru::create([
            "id" => $uuid['jemaatBaruId'],
            "jemaat_id" => $jemaat['id'],
            "ucapan_syukur_id" => $uuid['ucapanSyukurId'],
            "lampiran" => $request['lampiran'],
            "alamat_jemaat_baru" => $request['alamat_jemaat_baru'],
            "gereja_terakhir" => $request['gereja_terakhir'],
            "gereja_lama_lain" => $request['gereja_lama_lain'],
            "persembahan_tahunan" => $request['persembahan_tahunan'],
        ]);

        return redirect('/jemaatBaru/')
            ->with('succeed', "Jemaat Baru dengan nama ".$jemaat->nama." sudah tersimpan ke database")
        ;
    }


    public function show($id)
    {
        $jemaatBaru = JemaatBaru::customGet($id);
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $jemaatBaru->ucapan_syukur_id)->get();
        $ucapanSyukurToArray = array();
        foreach($ucapanSyukurs as $ucapanSyukur)
        {
            $ucapanSyukurToArray[$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
        }
        return view('transaksi.jemaatBaru.show', [
            'jemaatBaru' => $jemaatBaru,
            'ucapanSyukur' => $ucapanSyukurToArray
        ]);
    }


    public function edit($id, Sektor $sektor)
    {
        $jemaatBaru = JemaatBaru::customGet($id);
        //dd($jemaatBaru);
        $ucapanSyukurs = UcapanSyukur::where('ucapan_syukur_id', '=', $jemaatBaru->ucapan_syukur_id)->get();
        $ucapanSyukurToArray = array();
        foreach($ucapanSyukurs as $ucapanSyukur)
        {
            $ucapanSyukurToArray[$ucapanSyukur->untuk] = $ucapanSyukur->besaran;
        }
        //dd($ucapanSyukurToArray);
        return view('transaksi.jemaatBaru.edit', [
            'jemaat' => $jemaatBaru,
            'ucapanSyukur' => $ucapanSyukurToArray,
            'sektors' => $sektor->all(),
        ]);
    }


    public function update(\App\Http\Requests\StoreJemaatBaruRequest $request, $id)
    {
        $request['tanggal_lahir'] = date("Y-m-d",strToTime($request['tanggal_lahir']));
        $request['tanggal_anggota'] = date("Y-m-d",strToTime($request['tanggal_anggota']));

        $jemaatBaru = JemaatBaru::find($id)->fill($request->all());
        $jemaatBaru->save();
        $jemaat = Jemaat::withoutGlobalScope('temporary')->find($jemaatBaru->jemaat_id)->fill($request->all());
        $jemaat->save();

        $request->input('temporary') == 0 ? DetailKeluarga::where('jemaat_id', '=', $jemaatBaru->jemaat_id)->delete() : '';

        $tk_gereja = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'gereja')
            ->first()
        ;
        $tk_gereja->besaran = $request['tk_gereja'];
        $tk_gereja->save();
        $tk_majelis = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'majelis')
            ->first()
        ;
        $tk_majelis->besaran = $request['tk_majelis'];
        $tk_majelis->save();
        $tk_pendeta = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'pendeta')
            ->first()
        ;
        $tk_pendeta->besaran = $request['tk_pendeta'];
        $tk_pendeta->save();
        $tk_guru_huria = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'guru_huria')
            ->first()
        ;
        $tk_guru_huria->besaran = $request['tk_guru_huria'];
        $tk_guru_huria->save();
        $tk_pembangunan = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'pembangunan')
            ->first()
        ;
        $tk_pembangunan->besaran = $request['tk_pembangunan'];
        $tk_pembangunan->save();

        return redirect("/jemaatBaru/$id")
            ->with('succeed', "Perubahan Jemaat baru dengan nama ".$jemaat->nama." sudah tersimpan ke database")
        ;
    }


    public function destroy(JemaatBaru $jemaatBaru)
    {
        $jemaatId = $jemaatBaru->jemaat_id;
        $jemaatBaru->delete();
        UcapanSyukur::destroy($jemaatBaru->ucapan_syukur_id);
        DetailKeluarga::where('jemaat_id', '=', $jemaatId)->delete();
        $jemaat = Jemaat::withoutGlobalScope('temporary')->find($jemaatId);
        $jemaat->delete();

        return redirect('/jemaatBaru/')
            ->with('succeed', "Jemaat Baru dengan nama ".$jemaat->nama." telah dihapus dari database")
        ;
    }

    // private function saveJemaatBaru($validated, $jemaatBaruId = null)
    // {
    //     $uuid = array(
    //         'jemaatBaruId' => (string) Str::orderedUuid(),
    //         'ucapanSyukurId' => (string) Str::orderedUuid(),
    //     );

    //     $jemaat = new Jemaat();
    //     $jemaat = $jemaat->fill($validated);
    //     $jemaat->save();

    //     $ucapanSyukur = UcapanSyukur::create([
    //         "id" => $uuid['ucapanSyukurId'],
    //         "acara" => 'jemaatBaru',
    //         "record" => $uuid['jemaatBaruId'],
    //         "tk_gereja" => $validated['tk_gereja'],
    //         "tk_pendeta" => $validated['tk_pendeta'],
    //         "tk_majelis" => $validated['tk_majelis'],
    //         "tk_guru_huria" => $validated['tk_guru_huria'],
    //         "tk_pembangunan" => $validated['tk_pembangunan'],
    //         "tanggal" => $validated['tanggal_anggota']
    //     ]);

    //     $jemaatBaru = JemaatBaru::create([
    //         "id" => $uuid['jemaatBaruId'],
    //         "jemaat_id" => $jemaat['id'],
    //         "ucapan_syukur_id" => $uuid['ucapanSyukurId'],
    //         "alamat_jemaat_baru" => $validated['alamat_jemaat_baru'],
    //         "gereja_terakhir" => $validated['gereja_terakhir'],
    //         "gereja_lama_lain" => $validated['gereja_lama_lain'],
    //         "persembahan_tahunan" => $validated['persembahan_tahunan'],
    //     ]);

    //     return array(
    //         'jemaat' => $jemaat,
    //         'jemaatBaru' => $jemaatBaru
    //     );
    // }
}
