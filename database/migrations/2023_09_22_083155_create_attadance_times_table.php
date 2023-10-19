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
        Schema::create('attadance_times', function (Blueprint $table) {
            $table->foreignId('presence_id');
            $table->time('late')->nullable();
            $table->time('leave_early')->nullable();
            $table->boolean('absent')->nullable();
            $table->time('overtime')->nullable();
            $table->time('total_work_hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attadance_times');
    }
};
