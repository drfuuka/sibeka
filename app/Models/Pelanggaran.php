<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tr_pelanggaran';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jenis_pelanggaran_id',
        'pelapor',
    ];

    public function siswa() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jenisPelanggaran() {
        return $this->belongsTo(JenisPelanggaran::class, 'jenis_pelanggaran_id', 'id');
    }
}
