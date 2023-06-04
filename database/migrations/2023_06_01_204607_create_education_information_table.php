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
        Schema::create('education_information', function (Blueprint $table) {
            $table->id();
            $table->text('school_name')->nullable();
            $table->text('level')->nullable();
            $table->text('sttb_date_number')->nullable();
            $table->text('study_duration')->nullable();
            $table->text('move_school')->nullable();
            $table->text('transfer_date')->nullable();
            $table->text('reason')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_information');
    }
};
