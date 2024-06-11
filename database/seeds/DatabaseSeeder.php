<?php

use App\Models\GuruDetail;
use App\Models\JenisPelanggaran;
use App\Models\SiswaDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        if(!User::count()) {
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

        // buat data starter jenis pelanggaran
        if(!JenisPelanggaran::count()) {
            $violations = [
                ['jenis_pelanggaran' => 'Tidak melaksanakan piket sesuai dengan tugasnya', 'poin' => 2],
                ['jenis_pelanggaran' => 'Terlambat masuk 5 menit setelah bel masuk berbunyi', 'poin' => 2],
                ['jenis_pelanggaran' => 'Tidak masuk sekolah 1 hari tanpa keterangan', 'poin' => 5],
                ['jenis_pelanggaran' => 'Tidak mengikuti kegiatan belajar / bolos sekolah', 'poin' => 5],
                ['jenis_pelanggaran' => 'Tidak memakai seragam / baju seragam tidak dimasukkan', 'poin' => 2],
                ['jenis_pelanggaran' => 'Tidak memakai atribut sekolah yang telah ditentukan', 'poin' => 2],
                ['jenis_pelanggaran' => 'Berambut panjang / disemir, berkuku panjang', 'poin' => 3],
                ['jenis_pelanggaran' => 'Tidak membuat atau melaksanakan tugas guru / sekolah', 'poin' => 3],
                ['jenis_pelanggaran' => 'Berlaku tidak sopan didalam kelas atau dilingkungan sekolah', 'poin' => 2],
                ['jenis_pelanggaran' => 'Menghina / mencemooh guru dan karyawan', 'poin' => 25],
                ['jenis_pelanggaran' => 'Melawan secara fisik kepada guru / karyawan', 'poin' => 100],
                ['jenis_pelanggaran' => 'Tidak mengembalikan barang milik sekolah', 'poin' => 5],
                ['jenis_pelanggaran' => 'Membuat gaduh didalam kelas / lingkungan sekolah', 'poin' => 3],
                ['jenis_pelanggaran' => 'Memukul sesama teman di kelas / lingkungan sekolah', 'poin' => 15],
                ['jenis_pelanggaran' => 'Melakukan perkelahian didalam atau diluar sekolah', 'poin' => 35],
                ['jenis_pelanggaran' => 'Berjudi, minum-minuman keras atau mengedarkannya', 'poin' => 70],
                ['jenis_pelanggaran' => 'Membawa senjata tajam dan barang terlarang lainnya', 'poin' => 70],
                ['jenis_pelanggaran' => 'Merokok didalam kelas / lingkungan sekolah', 'poin' => 15],
                ['jenis_pelanggaran' => 'Mencuri barang milik orang lain / sekolah', 'poin' => 50],
                ['jenis_pelanggaran' => 'Mengubah, merobek atau mencoret jadwal, tembok, meja dll.', 'poin' => 15],
                ['jenis_pelanggaran' => 'Bergaul yang melampaui batas kewajaran (pria & wanita)', 'poin' => 50],
                ['jenis_pelanggaran' => 'Tidak mengikuti kegiatan yang diwajibkan sekolah', 'poin' => 5],
                ['jenis_pelanggaran' => 'Tidak mengikuti pelajaran jam tertentu', 'poin' => 5],
                ['jenis_pelanggaran' => 'Masuk kantor / kelas lain tanpa izin', 'poin' => 3],
                ['jenis_pelanggaran' => 'Merusak barang milik sekolah wajib mengganti', 'poin' => 25],
                ['jenis_pelanggaran' => 'Tidak mengikuti Tes / Ulangan tanpa keterangan', 'poin' => 15],
            ];
    
            DB::table('ms_pelanggaran')->insert($violations);
        }
    }
}
