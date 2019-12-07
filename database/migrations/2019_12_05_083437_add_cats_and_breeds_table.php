<?php

use Illuminate\Database\Migrations\Migration;

class AddCatsAndBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function ($table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->date('date_of_birth');
            $table->integer('breed_id')->nullable();
            $table->timestamps();
        });
        Schema::create('breeds', function ($table) {
            $table->increments('id');
            $table->string('name', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cats');
        Schema::drop('breeds');
    }
}
