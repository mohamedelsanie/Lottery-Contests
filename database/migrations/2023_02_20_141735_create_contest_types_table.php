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
        Schema::create('contest_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text('slug');
            $table->text('img');
            $table->enum('status', ['publish', 'pending', 'draft'])->default('publish');
            $table->integer('parent')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_types');
    }
};
