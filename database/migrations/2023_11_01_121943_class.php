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
        Schema::create('class', function (Blueprint $table) {
            $table->id();
            $table->string('section', 255);
            $table->bigInteger('school_id')->unsigned();
            $table->bigInteger('classadviser_id')->unsigned();
            $table->enum('grade_level', ['Kinder', 1, 2, 3, 4, 5, 6, 'SPED']);
            $table->bigInteger('schoolyear_id')->unsigned();
            $table->enum('is_deleted', [0, 1])->default(0);
            $table->bigInteger('section_id')->unsigned();
            $table->timestamps();

            // Adding foreign key constraints
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools_table')->onDelete('cascade');
            $table->foreign('classadviser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('schoolyear_id')->references('id')->on('school_year')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the foreign key constraint before dropping the table
        Schema::table('class', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropForeign(['classadviser_id']);
            $table->dropForeign(['schoolyear_id']);
        });

        Schema::dropIfExists('class');
    }
};
