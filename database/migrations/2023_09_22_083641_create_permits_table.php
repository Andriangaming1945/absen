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
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->integer('no_id');
            $table->foreign('no_id')->references('no_id')->on('users');
            $table->date('date');
            $table->foreignId('information_permit_id');
            $table->string('permit_document');
            $table->string('classroom_document')->nullable();
            $table->string('status_permit')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permits');
    }
};
