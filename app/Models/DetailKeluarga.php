<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Keluarga;
use App\Models\Jemaat;

class DetailKeluarga extends Model
{
    use HasFactory;

    protected $table = 'detail_keluarga';
    public $incrementing = false;

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'jemaat_id' , 'id');
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id' , 'id');
    }

    public static function findOrCreate($key, $col='id')
    {
        $obj = static::where($key, '=', $col)->first();
        $new = new static;
        $new->$col = $key;
        return $obj ?: $new;
    }

}