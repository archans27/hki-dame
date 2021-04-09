<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jemaat;
use Response;
use DB;

class JemaatController extends Controller
{
    private $limit = 5;

    public function index(Request $request)
    {
        $jemaat=Jemaat::where('nama', 'like', "%$request->hint%")->limit($this->limit)->get();
	    return Response::json($jemaat,200);
    }

    public function jemaatKatekisasi(Request $request)
    {
        $jemaat=Jemaat::where('nama', 'like', "%$request->hint%")->limit($this->limit)->get();
        return Response::json($jemaat,200);
    }

    public function kepalaKeluarga (Request $request)
    {
        $keluarga =  DB::table('keluarga')
            ->select('keluarga.id', 'keluarga.kepala_keluarga_id', 'keluarga.kepala_keluarga', 'keluarga.alamat_rumah' )
            ->where('keluarga.kepala_keluarga', 'like', "%$request->hint%")
            ->orderBy('keluarga.kepala_keluarga', 'asc')
            ->distinct()
            ->limit($this->limit)
            ->get()
        ;
        
        return Response::json($keluarga,200);
    }

    
    public function pekerjaan(Request $request)
    {
        $listPekerjaan = [
            'Belum / Tidak Bekerja',
            'Mengurus Rumah Tangga',
            'Pelajar / Mahasiswa',
            'Pensiunan',
            'Pegawai Negeri Sipil',
            'Tentara Nasional Indonesia',
            'Kepolisian RI',
            'Perdagangan',
            // 'Petani / Pekebun',
            // 'Peternak',
            // 'Nelayan / Perikanan',
            'Industri',
            'Konstruksi',
            'Transportasi',
            'Karyawan Swasta',
            'Karyawan BUMN',
            'Karyawan BUMD',
            'Karyawan Honorer',
            'Buruh Harian Lepas',
            // 'Buruh Tani / Perkebunan',
            // 'Buruh Nelayan / Perikanan',
            // 'Buruh Peternakan',
            'Pembantu Rumah Tangga',
            // 'Tukang Cukur',
            // 'Tukang Listrik',
            // 'Tukang Batu',
            // 'Tukang Kayu',
            // 'Tukang Sol Sepatu',
            // 'Tukang Las / Pandai Besi',
            // 'Tukang Jahit',
            'Penata Rias',
            'Penata Busana',
            'Penata Rambut',
            'Mekanik',
            // 'Tukang Gigi',
            'Seniman',
            // 'Tabib',
            // 'Paraji',
            'Perancang Busana',
            'Penterjemah',
            // 'Imam Masjid',
            'Pendeta',
            // 'Pastur',
            'Wartawan',
            // 'Ustadz / Mubaligh',
            'Juru Masak',
            'Promotor Acara',
            'Anggota DPR-RI',
            'Anggota DPD',
            'Anggota BPK',
            // 'Presiden',
            // 'Wakil Presiden',
            // 'Anggota Mahkamah Konstitusi',
            // 'Anggota Kabinet / Kementerian',
            // 'Duta Besar',
            // 'Gubernur',
            // 'Wakil Gubernur',
            // 'Bupati',
            // 'Wakil Bupati',
            // 'Walikota',
            // 'Wakil Walikota',
            'Anggota DPRD Provinsi',
            'Anggota DPRD Kabupaten / Kota',
            'Dosen',
            'Guru',
            'Pilot',
            'Pengacara',
            'Notaris',
            'Arsitek',
            'Akuntan',
            'Konsultan',
            'Dokter',
            'Bidan',
            'Perawat',
            'Apoteker',
            'Psikiater / Psikolog',
            // 'Penyiar Televisi',
            // 'Penyiar Radio',
            // 'Pelaut',
            'Peneliti',
            'Sopir',
            // 'Pialang',
            // 'Paranormal',
            'Pedagang',
            'Perangkat Desa',
            'Kepala Desa',
            // 'Biarawati',
            'Wiraswasta',
            'Lainnya'
        ];

        $result = preg_grep('~' . $request->hint . '~i', $listPekerjaan);
        $limitOutout = array_slice($result, 0, $this->limit);
        return response()->json($limitOutout);
    }
}
