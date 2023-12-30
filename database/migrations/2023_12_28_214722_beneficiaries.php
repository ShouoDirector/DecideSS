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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pupil_id')->unsigned();
            $table->bigInteger('classadviser_id')->unsigned();
            $table->bigInteger('school_nurse_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('schoolyear_id')->unsigned();
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 6, 2);
            $table->enum('bmi_category', ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese']);
            $table->enum('hfa_category', ['Severely Stunted', 'Stunted', 'Normal', 'Tall']);
            $table->enum('is_feeding_program', ['0', '1'])->default(0);
            $table->enum('is_deworming_program', ['0', '1'])->default(0);
            $table->enum('is_immunization_vax_program', ['0', '1'])->default(0);
            $table->enum('is_mental_healthcare_program', ['0', '1'])->default(0);
            $table->enum('is_dental_care_program', ['0', '1'])->default(0);
            $table->enum('is_eye_care_program', ['0', '1'])->default(0);
            $table->enum('is_health_wellness_program', ['0', '1'])->default(0);
            $table->enum('is_medical_support_program', ['0', '1'])->default(0);
            $table->enum('is_nursing_services', ['0', '1'])->default(0);
            $table->enum('iron_supplementation', ['0', '1'])->nullable();
            $table->enum('is_immunized', ['0', '1'])->nullable();
            $table->string('immunization_specify', 255)->nullable();
            $table->enum('menarche', ['0', '1'])->nullable();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('blood_pressure', 5, 2)->nullable();
            $table->decimal('heart_rate', 5, 2)->nullable();
            $table->decimal('pulse_rate', 5, 2)->nullable();
            $table->decimal('respiratory_rate', 5, 2)->nullable();
            $table->enum('vision_screening', ['0', '1'])->nullable();
            $table->enum('auditory_screening', ['0', '1'])->nullable();
            $table->string('skin_scalp', 255)->nullable();
            $table->string('eyes', 255)->nullable();
            $table->string('ear', 255)->nullable();
            $table->string('nose', 255)->nullable();
            $table->string('mouth', 255)->nullable();
            $table->string('neck', 255)->nullable();
            $table->string('throat', 255)->nullable();
            $table->string('lungs', 255)->nullable();
            $table->string('heart', 255)->nullable();
            $table->string('abdomen', 255)->nullable();
            $table->enum('deformities', ['1', '2'])->nullable();
            $table->string('deformity_specified', 255)->nullable();
            $table->date('date_of_examination')->nullable();
            $table->string('explanation', 255)->nullable();
            $table->enum('is_deleted', ['0', '1']);
            $table->timestamps();
            
            // Adding foreign key constraint
            $table->foreign('pupil_id')->references('id')->on('pupil')->onDelete('cascade');
            $table->foreign('classadviser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('school_nurse_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->dropForeign(['pupil_id']);
            $table->dropForeign(['classadviser_id']);
            $table->dropForeign(['school_nurse_id']);
            $table->dropForeign(['class_id']);
            $table->dropForeign(['schoolyear_id']);
        });

        Schema::dropIfExists('beneficiaries');
    }
};
