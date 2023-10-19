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
        Schema::create('working_days', function (Blueprint $table) {
            $table->foreignId('presence_id');
            $table->string('normal_day')->nullable();
            $table->string('weekend')->nullable();
            $table->string('holiday')->nullable();
            $table->string('total_presence')->nullable();
            $table->string('overtime_on_normal_days')->nullable();
            $table->string('weekend_overtime')->nullable();
            $table->string('holiday_overtime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_days');
    }
};
