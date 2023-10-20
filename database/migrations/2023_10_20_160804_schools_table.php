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
            $table->integer('school_id')->unique();
            $table->string('school', 50);
            $table->string('school_nurse_email')->unique()->nullable();
            $table->string('address_barangay', 255)->nullable();
            $table->string('district', 50);
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });

        // Adding foreign key constraint
        Schema::table('schools_table', function (Blueprint $table) {
            $table->foreign('school_nurse_email')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('district')->references('district')->on('districts_table')->onDelete('cascade');
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
            $table->dropForeign(['district']);
        });

        Schema::dropIfExists('schools_table');
    }
};
