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
        return $this->belongsTo(Jemaat::class);
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }

}