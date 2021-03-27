<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pernikahan extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'pernikahan';
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
