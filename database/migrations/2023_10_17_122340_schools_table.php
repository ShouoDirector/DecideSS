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
        Schema::create('schools_table', function (Blueprint $table) {
            $table->id();
            $table->string('school', 50)->unique();
            $table->string('school_nurse_email')->unique();
            $table->string('jurisdiction', 50)->unique();
            $table->timestamps();
        });

        // Adding foreign key constraint
        Schema::table('schools_table', function (Blueprint $table) {
            $table->foreign('school_nurse_email')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('jurisdiction')->references('division')->on('divisions_table')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the foreign key constraint before dropping the table
        Schema::table('schools_table', function (Blueprint $table) {
            $table->dropForeign(['school_nurse_email']);
            $table->dropForeign(['jurisdiction']);
        });

        Schema::dropIfExists('schools_table');
    }
};
