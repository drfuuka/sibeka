<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ms_siswa';

    protected $fillable = [
        'user_id',
        'nis',
        'nama_siswa',
        'kelas',
        'alamat',
        'nama_ortu',
        'tlp_ortu',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

