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
        Schema::create('nilai_raport', function (Blueprint $table) {
            $table->id('id_nilairaport');
           $table->foreignId('siswa_id');
            $table->foreignId('guru_id');
            $table->foreignId('mapel_id');
            $table->foreignId('thnakademik_id');
            $table->string('kelas_id',30);
            $table->string('slug',30);
            $table->string('semester',30);
            $table->double('nilai');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_raport');
    }
};
