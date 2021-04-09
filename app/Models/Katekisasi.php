<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DB;

class Katekisasi extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'katekisasi';
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public static function customGet($id = null)
    {
        $katekisasi = DB::table('katekisasi')
            ->select('katekisasi.*', 'jemaat.no_anggota', 'jemaat.nama', 'jemaat.tempat_lahir', 'jemaat.tanggal_lahir', 'jemaat.jenis_kelamin', 'jemaat.golongan_darah', 'jemaat.pendidikan', 'jemaat.pekerjaan', 'jemaat.tanggal_anggota', 'jemaat.nomor_telepon', 'keluarga.alamat_rumah')
            ->join('jemaat', 'jemaat.id', '=', 'katekisasi.jemaat_id')
            ->join('detail_keluarga', 'detail_keluarga.jemaat_id', '=', 'katekisasi.jemaat_id')
            ->join('keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->distinct()
        ;

        if ($id !== null){
            return $katekisasi->where('katekisasi.id', '=', $id)->first();
        }
        
        return $katekisasi->get();
    }
}
