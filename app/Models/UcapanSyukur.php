<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UcapanSyukur extends Model
{
    use HasFactory;
    protected $table = 'ucapan_syukur';
    protected $guarded = [];
    public $incrementing = false;
}
