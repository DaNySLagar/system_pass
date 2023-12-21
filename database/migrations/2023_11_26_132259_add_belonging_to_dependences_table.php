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
        Schema::table('dependences', function (Blueprint $table) {
            $table->unsignedBigInteger('belonging_to')->nullable();
            $table->foreign('belonging_to')->references('id')->on('dependences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dependences', function (Blueprint $table) {
            $table->dropColumn('belonging_to');
        });
    }
};
