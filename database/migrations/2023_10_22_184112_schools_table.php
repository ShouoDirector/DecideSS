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
        // Create districts_table first if it doesn't exist
        if (!Schema::hasTable('districts_table')) {
            Schema::create('districts_table', function (Blueprint $table) {
                $table->id();
                $table->string('district', 50)->unique();
                $table->bigInteger('medical_officer_id')->unsigned()->unique();
                $table->enum('is_deleted', [0, 1])->default(0);
                $table->timestamps();

                // Adding foreign key constraint
                $table->foreign('medical_officer_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        Schema::create('schools_table', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->unique();
            $table->string('school', 50);
            $table->bigInteger('school_nurse_id')->unsigned()->unique();
            $table->string('address_barangay', 255)->nullable();
            $table->bigInteger('district_id')->unsigned();
            $table->enum('is_deleted', [0, 1])->default(0);
            $table->timestamps();

            // Adding foreign key constraints
            $table->foreign('school_nurse_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts_table')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the foreign key constraint before dropping the table
        Schema::table('schools_table', function (Blueprint $table) {
            $table->dropForeign(['school_nurse_id']);
            $table->dropForeign(['district_id']);
        });

        Schema::dropIfExists('schools_table');
    }
};
