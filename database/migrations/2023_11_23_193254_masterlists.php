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
        Schema::create('masterlists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pupil_id')->unsigned()->unique();
            $table->bigInteger('classadviser_id')->unsigned()->unique();
            $table->bigInteger('class_id')->unsigned()->unique();
            $table->bigInteger('schoolyear_id')->unsigned()->unique();
            $table->timestamps();

            // Adding foreign key constraint
            $table->foreign('pupil_id')->references('id')->on('pupil')->onDelete('cascade');
            $table->foreign('classadviser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');
            $table->foreign('schoolyear_id')->references('id')->on('school_year')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the foreign key constraint before dropping the table
        Schema::table('masterlists', function (Blueprint $table) {
            $table->dropForeign(['pupil_id']);
            $table->dropForeign(['classadviser_id']);
            $table->dropForeign(['class_id']);
            $table->dropForeign(['schoolyear_id']);
        });

        Schema::dropIfExists('masterlists');
    }
};
