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
        Schema::create('student_development_information', function (Blueprint $table) {
            $table->id();
            $table->text('registration_date')->nullable();
            $table->text('leaving_date')->nullable();
            $table->text('scholarship_grantee')->nullable();
            $table->text('reason')->nullable();
            $table->text('finish_date')->nullable();
            $table->text('sttb_date_number')->nullable();
            $table->text('plan')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_development_information');
    }
};
