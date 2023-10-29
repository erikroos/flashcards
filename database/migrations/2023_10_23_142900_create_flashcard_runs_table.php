<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('runs', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('set_id');
            $table->foreign('set_id')->references('id')->on('sets');
            $table->unsignedSmallInteger('front2back');
            $table->unsignedSmallInteger('back2front');
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->integer('n_total')->default(0);
            $table->integer('n_correct')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runs');
    }
};
