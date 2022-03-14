<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStatistiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_statistiks', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->integer('downloads');
            $table->integer('views');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_statistiks');
    }
}



 
 

/*

 [
                'service_id' => $userData->id,
            ],
            [
                'downloads'=>$userData->downloads->total,
                'views'=>$userData->views->total
            ]

*/