<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPelanggaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ms_pelanggaran';

    protected $fillable = [
        'jenis_pelanggaran',
        'poin',
    ];
}
