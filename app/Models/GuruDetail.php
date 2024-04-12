<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ms_guru';

    protected $fillable = [
        'user_id',
        'nip',
        'nama_guru',
        'alamat',
        'no_hp',
        'jabatan',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

