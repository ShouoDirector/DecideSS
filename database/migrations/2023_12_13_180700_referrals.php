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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pupil_id')->unsigned();
            $table->bigInteger('classadviser_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('schoolyear_id')->unsigned();
            $table->bigInteger('school_nurse_id')->unsigned();
            $table->enum('program', ['Feeding Program', 'Deworming', 'Immunization Vax', 'Mental Healthcare', 'Dental Care']);
            $table->string('explanation', 255)->nullable();
            $table->enum('is_deleted', ['0', '1']);
            $table->timestamps();
            
            // Adding foreign key constraint
            $table->foreign('pupil_id')->references('id')->on('pupil')->onDelete('cascade');
            $table->foreign('classadviser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');
            $table->foreign('schoolyear_id')->references('id')->on('school_year')->onDelete('cascade');
            $table->foreign('school_nurse_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the foreign key constraint before dropping the table
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropForeign(['pupil_id']);
            $table->dropForeign(['classadviser_id']);
            $table->dropForeign(['class_id']);
            $table->dropForeign(['schoolyear_id']);
        });

        Schema::dropIfExists('referrals');
    }
};
