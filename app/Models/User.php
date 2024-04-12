<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'ms_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function detail()
    {
        if($this->role === 'Siswa') {
            return $this->hasOne(SiswaDetail::class);
        }
        if($this->role !== 'Admin') {
            return $this->hasOne(GuruDetail::class);
        }
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'user_id', 'id');
    }
}
