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
        Schema::create('tr_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('ms_user')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('jenis_pelanggaran');
            $table->integer('poin');
            $table->string('pelapor');
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
        Schema::dropIfExists('tr_pelanggaran');
    }
};
