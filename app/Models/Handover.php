<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handover extends Model
{
    protected $fillable = [
        'tanggal',
        'pekerjaan',
        'status_pekerjaan',
    ];
}