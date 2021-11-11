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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100)->nullable();
            $table->string('username', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('province', 50)->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 15)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password')->nullable();
            $table->string('photo')->nullable();
            $table->string('role', 15)->nullable();
            $table->string('status', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_access', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
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
