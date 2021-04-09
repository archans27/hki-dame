<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Models\DetailKeluarga;

class Jemaat extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'jemaat';
    protected $guarded = ['id'];
    protected $attributes = [
        'hidup' => true,
        'temporary' => false,
    ];

    protected static function booted()
    {
        static::addGlobalScope('temporary', function (Builder $builder) {
            $builder->where('temporary', '=', false);
        });

        static::creating(function ($model) {
            $model->id = Uuid::uuid4();
        });
    }

    public function DetailKeluarga()
    {
        return $this->hasOne(DetailKeluarga::class);
    }

    public function Keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }


}
