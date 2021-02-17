<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Jemaat extends Model
{
    use HasFactory;

    protected $table = 'jemaat';
    public $incrementing = false;
    protected $attributes = [
        'hidup' => true
    ];
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope('hidup', function (Builder $builder) {
            $builder->where('hidup', '=', true);
        });

        static::creating(function ($model) {
            $model->id = Uuid::uuid4();
        });
    }
}
