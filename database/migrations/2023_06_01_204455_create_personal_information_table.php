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
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('nickname')->nullable();
            $table->text('nisn')->nullable();
            $table->text('school_name')->nullable();
            $table->text('gender')->nullable();
            $table->text('birth_info')->nullable();
            $table->text('religion')->nullable();
            $table->text('citizen')->nullable();
            $table->text('child_number')->nullable();
            $table->text('total_siblings')->nullable();
            $table->text('total_half_siblings')->nullable();
            $table->text('total_a_siblings')->nullable();
            $table->text('child_type')->nullable();
            $table->text('language')->nullable();
            $table->text('phone')->nullable();
            $table->text('level')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
