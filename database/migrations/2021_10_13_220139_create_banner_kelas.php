<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->integer('id_kelas')->nullable();
            $table->string('gambar')->nullable();
            $table->string('kondisi')->nullable();
            $table->timestamps();
        });

        Schema::create('banner_kelas_kursus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_banner_kelas')->nullable();
            $table->integer('id_kursus')->nullable();
            $table->integer('order')->nullable();
            $table->string('kondisi')->nullable();
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
        Schema::dropIfExists('banner_kelas');
    }
}
