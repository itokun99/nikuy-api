<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigInteger('id_user')->primary();
            $table->string('nama_user', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin', 15)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password')->nullable();
            $table->string('foto')->nullable();
            $table->string('hak_akses', 15)->nullable();
            $table->string('status', 15)->nullable();
            $table->string('setuju', 5)->nullable();
            $table->integer('id_paket')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_preneur', function (Blueprint $table) {
            $table->integer('id_userpreneur')->autoIncrement();
            $table->string('nama_bisnis', 50)->nullable();
            $table->string('tahun_dirikan', 10)->nullable();
            $table->string('bidang_usaha', 50)->nullable();
            $table->string('akun_instagram', 50)->nullable();
            $table->string('page_facebook', 50)->nullable();
            $table->string('website_bisnis', 50)->nullable();
            $table->string('omset_bulanan', 50)->nullable();
            $table->string('jumlah_karyawan', 50)->nullable();
            $table->text('deskripsi_usaha')->nullable();
            $table->bigInteger('id_user')->nullable();
            $table->integer('id_provinsi')->nullable();
            $table->text('alamat_bisnis')->nullable();
            $table->string('email_bisnis', 50)->nullable();
            $table->string('telp_bisnis', 15)->nullable();
            $table->text('foto_usaha')->nullable();
            $table->string('industri', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('provinsi', function (Blueprint $table) {
            $table->integer('id_provinsi')->autoIncrement();
            $table->string('nama_provinsi', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sosmed', function (Blueprint $table) {
            $table->integer('id_sosmed')->autoIncrement();
            $table->string('nama_sosmed', 50)->nullable();
            $table->string('akun', 50)->nullable();
            $table->string('link_sosmed', 50)->nullable();
            $table->text('logo_sosmed')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('slider', function (Blueprint $table) {
            $table->integer('id_slider')->autoIncrement();
            $table->text('foto_slider')->nullable();
            $table->string('alt', 50)->nullable();
            $table->string('link', 50)->nullable();
            $table->integer('order')->nullable();
            $table->string('kondisi', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigInteger('id_transaksi')->autoIncrement();
            $table->string('nama_transaksi', 50)->nullable();
            $table->string('no_rek', 50)->nullable();
            $table->string('bank_asal', 50)->nullable();
            $table->string('nama_rekening', 50)->nullable();
            $table->timestamp('tgl_transaksi')->nullable();
            $table->timestamp('tgl_berakhir')->nullable();
            $table->integer('id_paket')->nullable();
            $table->integer('id_event')->nullable();
            $table->bigInteger('id_user')->nullable();
            $table->double('biaya_transaksi')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('baca_admin', 20)->nullable();
            $table->string('baca_member', 20)->nullable();
            $table->text('foto_struk')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event', function (Blueprint $table) {
            $table->integer('id_event')->autoIncrement();
            $table->string('nama_event', 50)->nullable();
            $table->date('tanggal_post')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('foto_event')->nullable();
            $table->bigInteger('id_user')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('venue', 50)->nullable();
            $table->dateTime('waktu')->nullable();
            $table->double('harga_event')->nullable();
            $table->integer('kuota')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('order_id')->nullable();
            $table->string('kondisi', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_daftar', function (Blueprint $table) {
            $table->integer('id_daftar')->autoIncrement();
            $table->integer('id_event')->nullable();
            $table->integer('id_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('info', function (Blueprint $table) {
            $table->integer('id_info')->autoIncrement();
            $table->string('jenis_info', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->date('tgl_info')->nullable();
            $table->text('foto_info')->nullable();
            $table->integer('id_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->integer('id_kelas')->autoIncrement();
            $table->string('nama_kelas')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('foto_kelas')->nullable();
            $table->string('kondisi', 15)->nullable();
            $table->text('pesan')->nullable();
            $table->integer('order_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('kontak_kami', function (Blueprint $table) {
            $table->integer('id_kontak')->autoIncrement();
            $table->string('nama_kontak', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('subyek', 50)->nullable();
            $table->string('status', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('kursus', function (Blueprint $table) {
            $table->integer('id_kursus')->autoIncrement();
            $table->string('nama_kursus', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('foto_kursus')->nullable();
            $table->integer('id_pilar')->nullable();
            $table->integer('id_paket')->nullable();
            $table->integer('id_kelas')->nullable();
            $table->integer('order_id')->nullable();
            $table->string('kondisi', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('kursus_file', function (Blueprint $table) {
            $table->integer('id_kursus')->autoIncrement();
            $table->string('nama_kursus', 50)->nullable();
            $table->text('file_kursus')->nullable();
            $table->integer('id_pilar')->nullable();
            $table->integer('id_paket')->nullable();
            $table->integer('id_kelas')->nullable();
            $table->integer('order_id')->nullable();
            $table->string('kondisi', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('paket_kelas', function (Blueprint $table) {
            $table->integer('id_paketkelas')->autoIncrement();
            $table->integer('id_paket')->nullable();
            $table->integer('id_kelas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('paket_member', function (Blueprint $table) {
            $table->integer('id_paket')->autoIncrement();
            $table->string('nama_paket', 50)->nullable();
            $table->double('harga_member')->nullable();
            $table->text('deskripsi_paket')->nullable();
            $table->string('kondisi', 15)->nullable();
            $table->integer('jumlah_kelas')->nullable();
            $table->text('foto_paket')->nullable();
            $table->string('masa_berlaku', 20)->nullable();
            $table->text('background')->nullable();
            $table->string('slug', 50)->nullable();
            $table->bigInteger('expiration')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pilar', function (Blueprint $table) {
            $table->integer('id_pilar')->autoIncrement();
            $table->string('nama_pilar', 50)->nullable();
            $table->text('desk_pilar')->nullable();
            $table->integer('id_kelas')->nullable();
            $table->integer('order_id')->nullable();
            $table->string('kondisi', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_paket', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->nullable();
            $table->integer('id_paket')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('masa_berlaku_paket', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jumlah_masa')->nullable();
            $table->string('tipe_masa')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rating_kelas', function (Blueprint $table) {
            $table->integer('id_rating')->autoIncrement();
            $table->integer('id_kelas')->nullable();
            $table->integer('level_rating')->nullable();
            $table->text('komentar')->nullable();
            $table->bigInteger('id_user')->nullable();
            $table->date('tgl_komen')->nullable();
            $table->string('ket_rating')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_status', function (Blueprint $table) {
            $table->integer('id_userstats')->autoIncrement();
            $table->bigInteger('id_user')->nullable();
            $table->integer('id_paket')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('riwayat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('tipe')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('riwayat_admin', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('tipe')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('akses', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable();
            $table->text('token')->nullable();
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
        Schema::dropIfExists('migration');
    }
}
