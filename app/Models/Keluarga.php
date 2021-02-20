<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Models\DetailKeluarga;
use App\Models\Jemaat;
use App\Models\Sektor;

class Keluarga extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'keluarga';
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = Uuid::uuid4();
        });
    }

    public function detailKeluarga()
    {
        return $this->hasMany(DetailKeluarga::class);
    }

    public function sektor()
    {
        return $this->hasMany(Sektor::class);
    }

    public function jemaat()
    {
        return $this->belongsToMany(Jemaat::class,'detail_keluarga', 'keluarga_id', 'jemaat_id');
    }
}
