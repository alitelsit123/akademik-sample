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
        Schema::create('unpresents', function (Blueprint $table) {
            $table->id();
            $table->integer('sick')->default(0)->nullable();
            $table->integer('permission')->default(0)->nullable();
            $table->integer('alpha')->default(0)->nullable();
            $table->unsignedBigInteger('student_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unpresents');
    }
};
