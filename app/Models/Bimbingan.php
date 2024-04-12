<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bimbingan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tr_bimbingan';

    protected $fillable = [
        'user_id',
        'tanggal',
        'bimbingan',
        'solusi',
    ];

    public function siswa() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
