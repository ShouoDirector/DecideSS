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
        Schema::create('cnsr_list', function (Blueprint $table) {
            $table->id();
            $table->string('cnsr_code', 255)->nullable();
            $table->bigInteger('school_id')->unsigned()->unique();
            $table->bigInteger('school_nurse_id')->unsigned()->unique();
            $table->bigInteger('school_year_id')->unsigned()->unique();
            $table->enum('is_approved', ['0', '1'])->default('0');
            $table->date('approved_date')->nullable();
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('school_id')->references('id')->on('schools_table');
            $table->foreign('school_nurse_id')->references('id')->on('users');
            $table->foreign('school_year_id')->references('id')->on('school_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cnsr_list');
    }
};
