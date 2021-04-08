<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DB;

class Meninggal extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'meninggal';
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public static function customGet($id = null)
    {
        $meninggal = DB::table('meninggal')
            ->select('meninggal.*', 'jemaat.no_anggota', 'jemaat.nama', 'jemaat.tempat_lahir', 'jemaat.tanggal_lahir', 'jemaat.jenis_kelamin', 'jemaat.golongan_darah', 'jemaat.pendidikan', 'jemaat.pekerjaan', 'jemaat.tanggal_anggota', 'keluarga.alamat_rumah')
            ->join('jemaat', 'jemaat.id', '=', 'meninggal.jemaat_id')
            ->join('detail_keluarga', 'detail_keluarga.jemaat_id', '=', 'meninggal.jemaat_id')
            ->join('keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->distinct()
        ;

        if ($id !== null){
            return $meninggal->where('meninggal.id', '=', $id)->first();
        }
        
        return $meninggal->get();
    }
}
