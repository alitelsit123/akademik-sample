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
        Schema::table('extracurriculars', function (Blueprint $table) {
          $table->string('semester')->nullable();
          $table->string('class_id');
          $table->string('school_year')->nullable();
        });
        Schema::table('unpresents', function (Blueprint $table) {
          $table->string('semester')->nullable();
          $table->string('class_id');
          $table->string('school_year')->nullable();
        });
        Schema::table('attitudes', function (Blueprint $table) {
          $table->string('semester')->nullable();
          $table->string('school_year')->nullable();
          $table->string('class_id');
        });
        Schema::table('performances', function (Blueprint $table) {
          $table->string('semester')->nullable();
          $table->string('school_year')->nullable();
          $table->string('class_id');
        });
        Schema::table('notes', function (Blueprint $table) {
          $table->string('semester')->nullable();
          $table->string('school_year')->nullable();
          $table->string('class_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extracurriculars', function (Blueprint $table) {
          $table->dropColumn(['semester','school_year','class_id']);
        });
        Schema::table('unpresents', function (Blueprint $table) {
          $table->dropColumn(['semester','school_year','class_id']);
        });
        Schema::table('attitudes', function (Blueprint $table) {
          $table->dropColumn(['semester','school_year','class_id']);
        });
        Schema::table('performances', function (Blueprint $table) {
          $table->dropColumn(['semester','school_year','class_id']);
        });
        Schema::table('notes', function (Blueprint $table) {
          $table->dropColumn(['semester','school_year','class_id']);
        });
    }
};
