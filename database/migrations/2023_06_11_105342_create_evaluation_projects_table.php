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
        Schema::create('evaluation_projects', function (Blueprint $table) {
            $table->id();
            $table->string('school_year');
            $table->string('semester');
            $table->string('bb')->nullable();
            $table->string('mb')->nullable();
            $table->string('bsh')->nullable();
            $table->string('sb')->nullable();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_projects');
    }
};
