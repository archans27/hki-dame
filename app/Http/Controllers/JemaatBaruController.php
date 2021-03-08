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
        $validated = $request->validated();

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

        return redirect('/jemaatBaru/')
            ->with('succeed', "Jemaat Baru dengan nama ".$jemaat->nama." sudah tersimpan ke database")
        ;
    }


    public function show($id)
    {
        $jemaatBaru = JemaatBaru::customGet($id);
        return view('transaksi.jemaatBaru.show', [ 'jemaatBaru' => $jemaatBaru ]);
    }


    public function edit($id, Sektor $sektor)
    {
        $jemaatBaru = JemaatBaru::customGet($id);
        return view('transaksi.jemaatBaru.edit', [
            'jemaat' => $jemaatBaru,
            'sektors' => $sektor->all()
        ]);
    }


    public function update(\App\Http\Requests\StoreJemaatBaruRequest $request, $id)
    {
        $validated = $request->validated();
        $jemaatBaru = JemaatBaru::find($id)->fill($validated);
        $jemaatBaru->save();
        $jemaat = Jemaat::withoutGlobalScope('temporary')->find($jemaatBaru->jemaat_id)->fill($validated);
        $jemaat->save();
        $ucapanSyukur = UcapanSyukur::find($jemaatBaru->ucapan_syukur_id)->fill($validated);
        $ucapanSyukur->save();

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
