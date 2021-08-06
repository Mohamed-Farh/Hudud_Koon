<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_number');
            // $table->string('password');
            $table->string('name');
            $table->bigInteger('id_number')->length(15);
            $table->string('phone')->nullable();
            $table->string('address');
            $table->integer('agent_id')->nullable();
            $table->string('file')->nullable();
            $table->string('place_zoom');
            $table->string('region')->nullable();

            $table->timestamps();
        });
        // DB::statement("ALTER TABLE results  AUTO_INCREMENT = 900400300;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('join');
    }
}
