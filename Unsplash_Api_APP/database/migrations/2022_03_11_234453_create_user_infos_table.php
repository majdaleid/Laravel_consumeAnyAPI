<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->string('last_Page_Call');
            $table->string('user_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_link');
            $table->string('profile_Image');
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
        Schema::dropIfExists('user_infos');
    }
}


/*
  [
                'service_id' => $userData->id,
            ],
            [
                'lastPageCall'=>$userData->updated_at,
                'user_name' => $userData->username,
                'email'=>$userData->email,
                'first_name'=>$userData->first_name,
                'last_name'=>$userData->last_name,
                'profile_link'=>$userData->links->html,
                'profile_Image'=>$userData->profile_image->large,
                'total_likes'=>$userData->total_likes
                
                //'token_expires_at' => $tokenData->token_expires_at,
            ]

                */