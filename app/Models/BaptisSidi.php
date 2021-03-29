<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaptisSidi extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'baptis_sidi';
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
