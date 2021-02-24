<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sintua extends Model
{
    use HasFactory;
    protected $table = 'sintua';
    protected $guarded = ['id'];
}
