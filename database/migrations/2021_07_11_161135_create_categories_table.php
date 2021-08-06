<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // $table->integer('agent_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('photo')->nullable();

            //Every Region Has Many Categories
            // $table->integer('region_id')->unsigned()->nullable();
            // $table->foreign('region_id')->references('id')
            //     ->on('regions')
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
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
        Schema::dropIfExists('categories');
    }
}
