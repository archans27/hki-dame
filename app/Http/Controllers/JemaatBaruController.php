<?php

namespace App\Http\Controllers;

use App\Models\JemaatBaru;
use App\Models\Jemaat;
use App\Models\Sektor;
use App\Models\UcapanSyukur;
use App\Models\DetailKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        //dd($jemaatBarus);
        return view('master.jemaatBaru.index', ['jemaatBarus' => $jemaatBarus]);
    }


    public function create(Jemaat $jemaat, Sektor $sektor)
    {
        return view('master.jemaatBaru.create', [
            'jemaat' => $jemaat,
            'sektors' => $sektor->all()
        ]);
    }


    public function store(\App\Http\Requests\StoreJemaatBaruRequest $request)
    {
        //dd($request);
        $validated = $request->validated();
        //dd($validated);

        $saved = $this->saveJemaatBaru($validated);
        return redirect('/jemaatBaru/'.$saved['jemaatBaru']->idJemaatBaru)
            ->with('succeed', "Jemaat Baru dengan nama ".$saved['jemaat']->nama." sudah tersimpan ke database")
        ;
    }


    public function show($id)
    {
        $jemaatBaru = JemaatBaru::customGet($id);
        return view('master.jemaatBaru.show', [ 'jemaatBaru' => $jemaatBaru ]);
    }


    public function edit($id, Sektor $sektor)
    {
        $jemaatBaru = JemaatBaru::customGet($id);

        return view('master.jemaatBaru.edit', [
            'jemaat' => $jemaatBaru,
            'sektors' => $sektor->all()
        ]);
    }


    public function update(\App\Http\Requests\StoreJemaatBaruRequest $request, $id)
    {
        $validated = $request->validated();

        dd(new UcapanSyukur);
        $saved = $this->saveJemaatBaru($validated);
        return redirect('/jemaatBaru/'.$saved['jemaatBaru']->idJemaatBaru)
            ->with('succeed', "Perubahan Jemaat baru dengan nama ".$saved['jemaat']->nama." sudah tersimpan ke database")
        ;
    }


    public function destroy(JemaatBaru $jemaatBaru)
    {
        $jemaatId = $jemaatBaru->jemaat_id;
        $jemaatBaru->delete();
        UcapanSyukur::destroy($jemaatBaru->ucapan_syukur_id);
        DetailKeluarga::where('jemaat_id', '=', $jemaatId)->delete();
        $jemaat = Jemaat::find($jemaatId);
        $jemaat->delete();

        return redirect('/jemaatBaru/')
            ->with('succeed', "Jemaat Baru dengan nama ".$jemaat->nama." telah dihapus dari database")
        ;
    }

    private function saveJemaatBaru($validated, $ucapanSyukurId = null, $jemaatBaruId = null)
    {
        $uuid = array(
            'ucapanSyukurId' => $ucapanSyukurId ?? (string) Str::orderedUuid(),
            'jemaatBaruId' => $jemaatBaruId ?? (string) Str::orderedUuid(),
        );

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
