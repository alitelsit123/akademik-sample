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
        Schema::create('health_information', function (Blueprint $table) {
            $table->id();
            $table->text('blood_group')->nullable();
            $table->text('disease_history')->nullable();
            $table->text('physical_abnormalities')->nullable();
            $table->text('height')->nullable();
            $table->text('weight')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_information');
    }
};
