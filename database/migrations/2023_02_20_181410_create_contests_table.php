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
        Schema::create('contests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('price')->nullable();
            $table->string('num_of')->nullable();
            $table->string('label_color')->nullable();
            $table->enum('status', ['publish', 'pending', 'draft'])->default('publish');
            $table->string('contest_type_id')->constrained('contest_types')->onDelete('cascade');
            $table->enum('comments_status', ['open', 'closed'])->default('open');
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
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
        Schema::dropIfExists('contests');
    }
};