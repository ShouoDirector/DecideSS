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
        Schema::create('divisions_table', function (Blueprint $table) {
            $table->id();
            $table->string('division', 50)->unique();
            $table->string('medical_officer_email')->unique();
            $table->timestamps();
        });

        // Adding foreign key constraint
        Schema::table('divisions_table', function (Blueprint $table) {
            $table->foreign('medical_officer_email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the foreign key constraint before dropping the table
        Schema::table('divisions_table', function (Blueprint $table) {
            $table->dropForeign(['medical_officer_email']);
        });

        Schema::dropIfExists('divisions_table');
    }
};

