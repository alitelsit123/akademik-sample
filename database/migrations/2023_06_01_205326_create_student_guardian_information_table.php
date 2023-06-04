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
        Schema::create('student_guardian_information', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('birth_information')->nullable();
            $table->text('religion')->nullable();
            $table->text('relation')->nullable();
            $table->text('citizen')->nullable();
            $table->text('highest_certificate')->nullable();
            $table->text('working_at')->nullable();
            $table->text('income')->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_guardian_information');
    }
};
