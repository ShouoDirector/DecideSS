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
        Schema::create('health_conduct', function (Blueprint $table) {
            $table->unsignedBigInteger('pupil_id');
            $table->unsignedBigInteger('class_id');
            $table->enum('vaccination1', ['0', '1']);
            $table->enum('vaccination2', ['0', '1']);
            $table->enum('vaccination3', ['0', '1']);
            $table->enum('vaccination4', ['0', '1']);
            $table->enum('feeding1', ['0', '1']);
            $table->enum('feeding2', ['0', '1']);
            $table->enum('feeding3', ['0', '1']);
            $table->enum('feeding4', ['0', '1']);
            $table->enum('feeding5', ['0', '1']);
            $table->enum('deworming1', ['0', '1']);
            $table->enum('deworming2', ['0', '1']);
            $table->enum('deworming3', ['0', '1']);
            $table->enum('deworming4', ['0', '1']);
            $table->enum('dental1', ['0', '1']);
            $table->enum('dental2', ['0', '1']);
            $table->enum('dental3', ['0', '1']);
            $table->enum('dental4', ['0', '1']);
            $table->enum('dental5', ['0', '1']);
            $table->enum('mental1', ['0', '1']);
            $table->enum('mental2', ['0', '1']);
            $table->enum('mental3', ['0', '1']);
            $table->enum('mental4', ['0', '1']);
            $table->enum('mental5', ['0', '1']);
            $table->enum('mental6', ['0', '1']);
            $table->enum('mental7', ['0', '1']);
            $table->enum('eye1', ['0', '1']);
            $table->enum('eye2', ['0', '1']);
            $table->enum('eye3', ['0', '1']);
            $table->enum('eye4', ['0', '1']);
            $table->enum('health1', ['0', '1']);
            $table->enum('health2', ['0', '1']);
            $table->enum('health3', ['0', '1']);
            $table->enum('health4', ['0', '1']);
            $table->enum('is_deleted', ['0', '1']);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('pupil_id')->references('id')->on('pupil');
            $table->foreign('class_id')->references('id')->on('class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraints first
        Schema::table('health_conduct', function (Blueprint $table) {
            $table->dropForeign(['pupil_id']);
            $table->dropForeign(['class_id']);
        });

        // Now, drop the 'nsr_list' table
        Schema::dropIfExists('health_conduct');
    }
};
