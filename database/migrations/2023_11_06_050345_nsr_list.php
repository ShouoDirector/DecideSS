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
        Schema::create('nsr_list', function (Blueprint $table) {
            $table->id();
            $table->string('nsr_code', 255);
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('class_adviser_id');
            $table->unsignedBigInteger('cnsr_id');
            $table->enum('is_approved', ['0', '1']);
            $table->enum('is_deleted', ['0', '1']);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('section_id')->references('id')->on('classroom');
            $table->foreign('class_adviser_id')->references('id')->on('users');
            $table->foreign('cnsr_id')->references('id')->on('cnsr_list');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nsr_list');
    }
};
