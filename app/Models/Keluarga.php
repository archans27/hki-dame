<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailKeluarga;

class Keluarga extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'keluarga';

    public function detailKeluarga()
    {
        return $this->hasMany(DetailKeluarga::class);
    }

}
