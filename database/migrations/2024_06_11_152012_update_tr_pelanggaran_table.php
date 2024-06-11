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
        Schema::table('tr_pelanggaran', function (Blueprint $table) {
            $table->dropColumn('poin');
            $table->dropColumn('jenis_pelanggaran');
            $table->foreignId('jenis_pelanggaran_id')->references('id')->on('ms_pelanggaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_pelanggaran', function (Blueprint $table) {
            $table->integer('poin');
            $table->string('jenis_pelanggaran');
            $table->dropColumn('jenis_pelanggaran_id');
        });
    }
};
