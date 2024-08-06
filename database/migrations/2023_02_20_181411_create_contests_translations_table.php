<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('description')->nullable();
            $table->string('label_text')->nullable();
            $table->string('to_place')->nullable();

            $table->unique(['contest_id', 'locale']);
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_translations');
    }
};