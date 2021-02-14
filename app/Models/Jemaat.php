<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope('hidup', function (Builder $builder) {
            $builder->where('hidup', '=', true);
        });
    }
}
