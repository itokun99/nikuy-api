<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invitation')->nullable();
            $table->string('cover')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn("cover_image");
            $table->dropColumn("thumbnail_image");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitation_images');
    }
}
