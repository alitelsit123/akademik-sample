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
        Schema::create('parent_information', function (Blueprint $table) {
            $table->id();
            $table->text('father_name')->nullable();
            $table->text('mother_name')->nullable();
            $table->text('father_birth_information')->nullable();
            $table->text('mother_birth_information')->nullable();
            $table->text('father_religion')->nullable();
            $table->text('mother_religion')->nullable();
            $table->text('father_citizen')->nullable();
            $table->text('mother_citizen')->nullable();
            $table->text('father_highest_certificate')->nullable();
            $table->text('mother_highest_certificate')->nullable();
            $table->text('father_working_at')->nullable();
            $table->text('mother_working_at')->nullable();
            $table->text('father_income')->nullable();
            $table->text('mother_income')->nullable();
            $table->text('father_address')->nullable();
            $table->text('mother_address')->nullable();
            $table->text('father_phone')->nullable();
            $table->text('mother_phone')->nullable();
            $table->text('father_alive')->nullable();
            $table->text('mother_alive')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_information');
    }
};
