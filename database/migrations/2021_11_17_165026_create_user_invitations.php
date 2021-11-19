<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInvitations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('address')->nullable();
            $table->string('googlemap')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invitation_couples', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('invitation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invitation_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->string('location')->nullable();
            $table->string('invitation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invitation_videos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('url')->nullable();
            $table->string('invitation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invitation_galleries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('url')->nullable();
            $table->string('invitation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invitation_rekening', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('rekening')->nullable();
            $table->string('bank')->nullable();
            $table->string('owner')->nullable();
            $table->string('invitation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invitation_ewallets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('akun')->nullable();
            $table->string('qr')->nullable();
            $table->string('invitation')->nullable();
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
        Schema::dropIfExists('user_invitations');
    }
}
