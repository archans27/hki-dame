<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKeluarga;
use App\Models\Keluarga;
use App\Models\Jemaat;
use App\Enums\AnggotaKeluargaEnum;
use Illuminate\Support\Facades\View as ViewFacade;
use DB;
use PDF;

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
        $request->validate([
            'jemaat_id' => 'required|exists:jemaat,id',
            'hubungan' => 'required'
        ]);

            $detailKeluarga = DetailKeluarga::where('jemaat_id', '=', $request->jemaat_id)->first();
            if(!isset($detailKeluarga)){
                $detailKeluarga = new DetailKeluarga();
                $detailKeluarga->jemaat_id = $request->jemaat_id;
            }
            $detailKeluarga->keluarga_id = $request->keluarga_id;
            $detailKeluarga->hubungan = $request->hubungan;
            $keluarga = Keluarga::where('id', '=', $detailKeluarga->keluarga_id)->first();
            $jemaat = Jemaat::where('id', '=', $detailKeluarga->jemaat_id)->first();
            $hubungan = str_replace(' ', '_', strtolower($request->hubungan));
            $countChildren = DB::select('select count(1) + 1 as total from detail_keluarga where LOWER(hubungan) = ? AND keluarga_id = ?', [$hubungan, $detailKeluarga->keluarga_id]);
            $total = $countChildren[0]->total;
            switch ($hubungan) {
                case AnggotaKeluargaEnum::istri();
                    $jemaat->no_anggota = $keluarga->no_keluarga.'002';
                    break;

                case AnggotaKeluargaEnum::anak();
                    $countChildren = DB::select('select count(1) + 3 as total from detail_keluarga where LOWER(hubungan) = ? AND keluarga_id = ?', [$hubungan, $detailKeluarga->keluarga_id]);
                    $total = $countChildren[0]->total;
                    $totalString = strlen($total) == 1 ? '00'.$total : '0'.$total;
                    $jemaat->no_anggota = $keluarga->no_keluarga.$totalString;
                    break;

                case AnggotaKeluargaEnum::famili_lain();
                    $countChildren = DB::select('select count(1) + 1 as total from detail_keluarga where LOWER(hubungan) = ? AND keluarga_id = ?', [$hubungan, $detailKeluarga->keluarga_id]);
                    $total = $countChildren[0]->total;
                    $totalString = strlen($total) == 1 ? '10'.$total : '1'.$total;
                    $jemaat->no_anggota = $keluarga->no_keluarga.$totalString;
                    break;
            }
            $jemaat->is_naposo = '0';
            $jemaat->save();
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
        if ($detailKeluarga) {
            $detailKeluarga->delete();
        }
        $keluargasCount = DetailKeluarga::where('keluarga_id' , '=', $detailKeluarga->keluarga_id)->count();

        if (!$keluargasCount){
            $keluargas = Keluarga::find($detailKeluarga->keluarga_id)->delete();
            return redirect('/keluarga');
        }

        return redirect()->back();
    }
    public function generatePDFDetailKeluarga(Request $request, Keluarga $keluarga)
{
    $request_pdf = $request->session()->get('request_pdf_detailkeluarga');
    $sector = $request_pdf ? $request_pdf->sector : null;
    $search = $request_pdf ? $request_pdf->search : null;
    $orderFrom = $request_pdf ? $request_pdf->orderFrom : null;
    $orderBy = $request_pdf ? $request_pdf->orderBy : null;

    $query = DB::table('keluarga')
        ->select(
            'keluarga.id as keluarga_id',
            'keluarga.kepala_keluarga',
            'keluarga.no_keluarga',
            'sektor.nama as nama_sektor',
            'keluarga.alamat_rumah',
            'keluarga.status_rumah'
        )
        ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
        ->join('sektor', 'keluarga.sektor_id', '=', 'sektor.id')
        ->where('keluarga.is_pindah', 0)
        ->where('keluarga.id', $keluarga->id);

    if ($search) {
        $query->where('keluarga.kepala_keluarga', 'like', "%$search%");
    }

    $keluargaDetails = $query->first();

    // Check if $keluargaDetails is not null before accessing its properties
    if ($keluargaDetails) {
        // Retrieve family members' details
        $familyMembers = DB::table('detail_keluarga')
        ->select(
            'jemaat.nama as nama_anggota_keluarga',
            'detail_keluarga.hubungan',
            'jemaat.jenis_kelamin',
            'jemaat.tanggal_lahir'
        )
        ->join('jemaat', 'detail_keluarga.jemaat_id', '=', 'jemaat.id')
        ->where('detail_keluarga.keluarga_id', $keluargaDetails->keluarga_id)
        ->get();

    // Debugging statement
    dd($keluargaDetails, $familyMembers);

    $pdf = PDF::loadView('master.keluarga.pdfdetailkeluarga', [
        'keluarga' => $keluargaDetails,
        'familyMembers' => $familyMembers,
        'filter' => $request_pdf,
    ]);

    return $pdf->stream('Detail Keluarga.pdf', ['Attachment' => 0]);

}
}

}
