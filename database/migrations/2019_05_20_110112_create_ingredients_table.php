<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->default('slug');
            $table->timestamps();
        });

        Schema::create('ingredient_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ingredient_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title');

            $table->unique(['ingredient_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('ingredient_translations');
    }
}
