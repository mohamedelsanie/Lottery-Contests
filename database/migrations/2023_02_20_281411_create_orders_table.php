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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('adress')->nullable();
            $table->unsignedBigInteger('contest_id')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('user_name')->nullable();
            $table->string('img')->nullable();
            $table->string('invoice_id')->nullable();
            $table->enum('win_type', ['winner', 'loser'])->default('loser');
            $table->enum('status', ['not_payed', 'payed', 'canceled'])->default('not_payed');
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
        Schema::dropIfExists('orders');
    }
};