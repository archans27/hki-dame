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

    public function index(JemaatBaru $jemaatBaru)
    {
        $jemaatBarus = DB::table('jemaat_baru')
            ->select('jemaat_baru.*', 'jemaat.*', 'jemaat_baru.id AS idJemaatBaru', )
            ->join('jemaat', 'jemaat.id', '=', 'jemaat_baru.jemaat_id')
            ->distinct()
            ->paginate(5)
        ;
        return view('transaksi.jemaatBaru.index', ['jemaatBarus' => $jemaatBarus]);
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
        $request['tanggal_lahir'] = date("Y-m-d",strToTime($request['tanggal_lahir']));
        $request['tanggal_anggota'] = date("Y-m-d",strToTime($request['tanggal_anggota']));

        $uuid = array(
            'jemaatBaruId' => (string) Str::orderedUuid(),
            'ucapanSyukurId' => (string) Str::orderedUuid(),
        );
        if (Auth::user()->role != 'super') {
            $validated['temporary'] = true;
        }

        $jemaat = new Jemaat();
        $jemaat = $jemaat->fill($validated);
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
        //     "tk_pengembangan" => $validated['tk_pengembangan'],
        //     "tanggal" => $validated['tanggal_anggota']
        // ]);

        //TODO Project Lead want (array style)
        $tk_gereja = new UcapanSyukur();
        $tk_gereja->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_gereja->untuk = "gereja";
        $tk_gereja->besaran = $validated['tk_gereja'];
        $tk_gereja->dari_acara = "jemaatBaru";
        $tk_gereja->record = $uuid['jemaatBaruId'];
        $tk_gereja->tanggal = $validated['tanggal_anggota'];
        $tk_gereja->save();
        $tk_pendeta = new UcapanSyukur();
        $tk_pendeta->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_pendeta->untuk = "pendeta";
        $tk_pendeta->besaran = $validated['tk_pendeta'];
        $tk_pendeta->dari_acara = "jemaatBaru";
        $tk_pendeta->record = $uuid['jemaatBaruId'];
        $tk_pendeta->tanggal = $validated['tanggal_anggota'];
        $tk_pendeta->save();
        $tk_majelis = new UcapanSyukur();
        $tk_majelis->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_majelis->untuk = "majelis";
        $tk_majelis->besaran = $validated['tk_majelis'];
        $tk_majelis->dari_acara = "jemaatBaru";
        $tk_majelis->record = $uuid['jemaatBaruId'];
        $tk_majelis->tanggal = $validated['tanggal_anggota'];
        $tk_majelis->save();
        $tk_guru_huria = new UcapanSyukur();
        $tk_guru_huria->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_guru_huria->untuk = "guru_huria";
        $tk_guru_huria->besaran = $validated['tk_guru_huria'];
        $tk_guru_huria->dari_acara = "jemaatBaru";
        $tk_guru_huria->record = $uuid['jemaatBaruId'];
        $tk_guru_huria->tanggal = $validated['tanggal_anggota'];
        $tk_guru_huria->save();
        $tk_pengembangan = new UcapanSyukur();
        $tk_pengembangan->ucapan_syukur_id = $uuid['ucapanSyukurId'];
        $tk_pengembangan->untuk = "pengembangan";
        $tk_pengembangan->besaran = $validated['tk_pengembangan'];
        $tk_pengembangan->dari_acara = "jemaatBaru";
        $tk_pengembangan->record = $uuid['jemaatBaruId'];
        $tk_pengembangan->tanggal = $validated['tanggal_anggota'];
        $tk_pengembangan->save();

        

        $jemaatBaru = JemaatBaru::create([
            "id" => $uuid['jemaatBaruId'],
            "jemaat_id" => $jemaat['id'],
            "ucapan_syukur_id" => $uuid['ucapanSyukurId'],
            "alamat_jemaat_baru" => $validated['alamat_jemaat_baru'],
            "gereja_terakhir" => $validated['gereja_terakhir'],
            "gereja_lama_lain" => $validated['gereja_lama_lain'],
            "persembahan_tahunan" => $validated['persembahan_tahunan'],
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

        $tk_gereja = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'gereja')
            ->first()
        ;
        $tk_gereja->besaran = $request['tk_gereja'];
        $tk_gereja->save();
        $tk_pendeta = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'pendeta')
            ->first()
        ;
        $tk_pendeta->besaran = $request['tk_pendeta'];
        $tk_pendeta->save();
        $tk_majelis = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'majelis')
            ->first()
        ;
        $tk_majelis->besaran = $request['tk_majelis'];
        $tk_majelis->save();
        $tk_guru_huria = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'guru_huria')
            ->first()
        ;
        $tk_guru_huria->besaran = $request['tk_guru_huria'];
        $tk_guru_huria->save();
        $tk_pengembangan = UcapanSyukur::where('ucapan_syukur_id','=',$jemaatBaru->ucapan_syukur_id)
            ->where('untuk', '=', 'pengembangan')
            ->first()
        ;
        $tk_pengembangan->besaran = $request['tk_pengembangan'];
        $tk_pengembangan->save();

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

    private function saveJemaatBaru($validated, $jemaatBaruId = null)
    {
        $uuid = array(
            'jemaatBaruId' => (string) Str::orderedUuid(),
            'ucapanSyukurId' => (string) Str::orderedUuid(),
        );

        $jemaat = new Jemaat();
        $jemaat = $jemaat->fill($validated);
        $jemaat->save();

        $ucapanSyukur = UcapanSyukur::create([
            "id" => $uuid['ucapanSyukurId'],
            "acara" => 'jemaatBaru',
            "record" => $uuid['jemaatBaruId'],
            "tk_gereja" => $validated['tk_gereja'],
            "tk_pendeta" => $validated['tk_pendeta'],
            "tk_majelis" => $validated['tk_majelis'],
            "tk_guru_huria" => $validated['tk_guru_huria'],
            "tk_pengembangan" => $validated['tk_pengembangan'],
            "tanggal" => $validated['tanggal_anggota']
        ]);

        $jemaatBaru = JemaatBaru::create([
            "id" => $uuid['jemaatBaruId'],
            "jemaat_id" => $jemaat['id'],
            "ucapan_syukur_id" => $uuid['ucapanSyukurId'],
            "alamat_jemaat_baru" => $validated['alamat_jemaat_baru'],
            "gereja_terakhir" => $validated['gereja_terakhir'],
            "gereja_lama_lain" => $validated['gereja_lama_lain'],
            "persembahan_tahunan" => $validated['persembahan_tahunan'],
        ]);

        return array(
            'jemaat' => $jemaat,
            'jemaatBaru' => $jemaatBaru
        );
    }
}
