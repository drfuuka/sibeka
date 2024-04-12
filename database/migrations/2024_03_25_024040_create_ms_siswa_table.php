<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('ms_user')->onDelete('cascade');
            $table->integer('nis');
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->string('alamat');
            $table->string('nama_ortu');
            $table->string('tlp_ortu');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_siswa');
    }
};
