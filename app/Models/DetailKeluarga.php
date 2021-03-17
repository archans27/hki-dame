<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Models\Keluarga;
use App\Models\Jemaat;
use Illuminate\Database\Eloquent\Builder;

class DetailKeluarga extends Model
{
    use HasFactory;

    protected $table = 'detail_keluarga';
    public $incrementing = false;
    protected $guarded = ['id'];

    protected $attributes = [
        'temporary' => false,
    ];

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'jemaat_id' , 'id');
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id' , 'id');
    }

    protected static function booted()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Uuid::uuid4();
        });

        static::addGlobalScope('temporary', function (Builder $builder) {
            $builder->where('temporary', '=', false);
        });
    }

}