<?php

use App\Models\GuruDetail;
use App\Models\SiswaDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // buat data starter admin
        User::create([
            'username' => 'admin',
            'email'    => 'admin@mail.com',
            'password' => Hash::make(123123),
        ]);
        
        // buat data starter siswa
        $siswa = User::create([
            'username' => 'siswa',
            'email'    => 'siswa@mail.com',
            'password' => Hash::make(123123),
            'role'     => 'Siswa'
        ]);

        SiswaDetail::create([
            'user_id'    => $siswa->id,
            'nis'        => '912300013',
            'nama_siswa' => 'Richard',
            'kelas'      => '12',
            'alamat'     => 'Jl. Anggrek Boulevard',
            'nama_ortu'  => 'Steve',
            'tlp_ortu'   => '0812345678',
        ]);

        // buat data starter guru
        $guru = User::create([
            'username' => 'guru',
            'email'    => 'guru@mail.com',
            'password' => Hash::make(123123),
            'role'     => 'Guru'
        ]);

        GuruDetail::create([
            'user_id'   => $guru->id,
            'nip'       => '1220008239',
            'nama_guru' => 'Fransisco',
            'alamat'    => 'Jl. Fountaine',
            'no_hp'     => '081234123',
            'jabatan'   => 'Guru Matematika',
        ]);

        // buat data starter guru bk
        $bk = User::create([
            'username' => 'bk',
            'email'    => 'bk@mail.com',
            'password' => Hash::make(123123),
            'role'     => 'BK'
        ]);

        GuruDetail::create([
            'user_id'   => $bk->id,
            'nip'       => '1220008239',
            'nama_guru' => 'Diluc',
            'alamat'    => 'Jl. Dawn Winery',
            'no_hp'     => '081234123',
            'jabatan'   => 'Guru BK',
        ]);
    }
}
