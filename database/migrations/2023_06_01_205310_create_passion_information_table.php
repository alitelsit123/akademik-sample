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
        Schema::create('passion_information', function (Blueprint $table) {
            $table->id();
            $table->text('art')->nullable();
            $table->text('pysics')->nullable();
            $table->text('organization')->nullable();
            $table->text('etc')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passion_information');
    }
};
