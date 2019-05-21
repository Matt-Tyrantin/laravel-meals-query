<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->unsignedInteger('category_id')->nullable();

            $table->timestamps();
        });

        Schema::create('meal_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('meal_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title');
            $table->string('description');

            $table->unique(['meal_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
        Schema::dropIfExists('meal_translations');
    }
}
