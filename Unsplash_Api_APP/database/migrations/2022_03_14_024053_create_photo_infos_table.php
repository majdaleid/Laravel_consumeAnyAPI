<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_infos', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->longText('description')->nullable();
            $table->string('profile_Image');
            $table->string('photo_link');
            $table->integer('total_likes');
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
        Schema::dropIfExists('photo_infos');
    }
}
