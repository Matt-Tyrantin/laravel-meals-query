<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->default('slug');
            $table->timestamps();
        });

        Schema::create('tag_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tag_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title');

            $table->unique(['tag_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_translations');
    }
}
