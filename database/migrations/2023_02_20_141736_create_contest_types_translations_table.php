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
        Schema::create('contest_types_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_type_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('descraption')->nullable();

            $table->unique(['contest_type_id', 'locale']);
            $table->foreign('contest_type_id')->references('id')->on('contest_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_types_translations');
    }
};
