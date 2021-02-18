<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailKeluarga;
use App\Models\Jemaat;

class Keluarga extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'keluarga';

    public function detailKeluarga()
    {
        return $this->hasMany(DetailKeluarga::class);
    }

    public function jemaat()
    {
        return $this->belongsToMany(Jemaat::class,'detail_keluarga', 'keluarga_id', 'jemaat_id');
    }
}
