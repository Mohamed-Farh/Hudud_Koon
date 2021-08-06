<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo')->nullable();

            //Every places Has Many discounts
            $table->integer('place_id')->unsigned()->nullable();
            $table->foreign('place_id')->references('id')
                ->on('places')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->longText('description')->nullable();
            $table->string('name')->nullable();
            $table->double('price')->nullable();
            $table->double('discount')->nullable();
            $table->double('new_price')->nullable();

            $table->date('start_day')->nullable();
            $table->date('end_day')->nullable();

            $table->enum('type', ['عرض', 'كوبون'])->nullable();
            $table->longText('notes')->nullable();
            $table->enum('status', ['0', '1'])->nullable()->default('0');
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
        Schema::dropIfExists('discounts');
    }
}
