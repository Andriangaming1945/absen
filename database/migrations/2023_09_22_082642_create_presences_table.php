<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->integer('no_id');
            $table->foreign('no_id')->references('no_id')->on('users');
            $table->date('date');
            $table->time('entry_time');
            $table->time('exit_time');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->string('normal')->default("1");
            $table->string('riil')->nullable();
            $table->string('department')->default('TELKOMSCHOOL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
