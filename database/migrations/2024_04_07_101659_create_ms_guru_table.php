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
        Schema::create('ms_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('ms_user')->onDelete('cascade');
            $table->integer('nip');
            $table->string('nama_guru');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('jabatan');
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
        Schema::dropIfExists('ms_guru');
    }
};
