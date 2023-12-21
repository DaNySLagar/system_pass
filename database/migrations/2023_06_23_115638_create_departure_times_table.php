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
        Schema::create('departure_times', function (Blueprint $table) {
            $table->id();
            $table->time('hour_departure');
            $table->unsignedBigInteger('pass_id');
            $table->timestamps();

            $table->foreign('pass_id')
                    ->references('id')
                    ->on('passes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departure_times');
    }
};
