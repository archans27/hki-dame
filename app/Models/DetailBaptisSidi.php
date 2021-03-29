<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DetailBaptisSidi extends Model
{
    use HasFactory;
    protected $table = 'detail_baptis_sidi';
    protected $guarded = ['id'];

    protected static function booted()
    {
    }
}
