<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Sintua extends Model
{
    use HasFactory;
    protected $table = 'sintua';
    protected $guarded = ['id'];

    public static function customGet($id = null){
        $sintuas = DB::table('sintua')
            ->select('jemaat.nama AS nama', 'sektor.nama AS nama_sektor', 'sintua.*', 'jemaat.id AS jemaat_id')
            ->join('jemaat', 'sintua.jemaat_id' , '=', 'jemaat.id')
            ->join('sektor', 'sintua.sektor_id' , '=', 'sektor.id')
            ->orderBy('jemaat.nama', 'asc')
        ;

        if ($id !== null){
            return $sintuas->where('sintua.id', '=', $id)->first();
        }
        
        return $sintuas->get();
    }
}
