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
        Schema::create('pupil_nutritional_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('pna_code', 50);
            $table->bigInteger('nsr_id')->unsigned()->nullable();
            $table->bigInteger('pupil_id')->unsigned();
            $table->bigInteger('class_adviser_id')->unsigned();
            $table->bigInteger('schoolyear_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 6, 2);
            $table->enum('bmi', ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese']);
            $table->enum('hfa', ['Severely Stunted', 'Stunted', 'Normal', 'Tall']);
            $table->enum('is_dewormed', ['0', '1']);
            $table->string('dewormed_date', 255)->nullable();
            $table->enum('is_permitted_deworming', ['0', '1']);
            $table->string('explanation', 255)->nullable();
            $table->string('dietary_restriction', 255)->nullable();
            $table->enum('is_deleted', ['0', '1']);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('nsr_id')->references('id')->on('nsr_list');
            $table->foreign('pupil_id')->references('id')->on('pupil');
            $table->foreign('class_adviser_id')->references('id')->on('users');
            $table->foreign('schoolyear_id')->references('id')->on('school_year');
            $table->foreign('class_id')->references('id')->on('class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pupil_nutritional_assessments');
    }
};
