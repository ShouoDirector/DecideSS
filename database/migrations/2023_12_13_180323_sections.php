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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_code', 255);
            $table->string('section_name', 255);
            $table->enum('grade_level', ['Kinder', 1, 2, 3, 4, 5, 6, 'SPED']);
            $table->unsignedBigInteger('school_id');
            $table->enum('is_deleted', ['0', '1']);
            $table->timestamps();

            // Adding foreign key constraint
            $table->foreign('school_id')->references('id')->on('schools_table')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the foreign key constraint before dropping the table
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
        });

        Schema::dropIfExists('sections');
    }
};