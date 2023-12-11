<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class JemaatBaru extends Model
{
    use HasFactory;
    protected $table = 'jemaat_baru';
    protected $guarded = [''];
    public $incrementing = false;

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class);

    }

    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }
    
    public static function customGet($id = null)
    {
        $jemaatBaru = DB::table('jemaat_baru')
            ->select('jemaat.*', 'jemaat_baru.*', 'jemaat_baru.id AS idJemaatBaru')
            ->join('jemaat', 'jemaat.id', '=', 'jemaat_baru.jemaat_id')
            ->distinct()
        ;

        if ($id !== null){
            return $jemaatBaru->where('jemaat_baru.id', '=', $id)->first();
        }

        return $jemaatBaru->get();
    }

}
