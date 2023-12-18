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
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('school_nurse_id');
            $table->unsignedBigInteger('schoolyear_id');
            $table->integer('no_of_pupils')->nullable();
            $table->integer('no_of_male_pupils')->nullable();
            $table->integer('no_of_female_pupils')->nullable();
            $table->integer('no_of_severely_stunted')->nullable();
            $table->integer('no_of_male_severely_stunted')->nullable();
            $table->integer('no_of_female_severely_stunted')->nullable();
            $table->integer('no_of_stunted')->nullable();
            $table->integer('no_of_male_stunted')->nullable();
            $table->integer('no_of_female_stunted')->nullable();
            $table->integer('no_of_height_normal')->nullable();
            $table->integer('no_of_male_height_normal')->nullable();
            $table->integer('no_of_female_height_normal')->nullable();
            $table->integer('no_of_tall')->nullable();
            $table->integer('no_of_male_tall')->nullable();
            $table->integer('no_of_female_tall')->nullable();
            $table->integer('no_of_stunted_pupils')->nullable();
            $table->integer('no_of_male_stunted_pupils')->nullable();
            $table->integer('no_of_female_stunted_pupils')->nullable();
            $table->integer('no_of_severely_wasted')->nullable();
            $table->integer('no_of_male_severely_wasted')->nullable();
            $table->integer('no_of_female_severely_wasted')->nullable();
            $table->integer('no_of_wasted')->nullable();
            $table->integer('no_of_male_wasted')->nullable();
            $table->integer('no_of_female_wasted')->nullable();
            $table->integer('no_of_weight_normal')->nullable();
            $table->integer('no_of_male_weight_normal')->nullable();
            $table->integer('no_of_female_weight_normal')->nullable();
            $table->integer('no_of_overweight')->nullable();
            $table->integer('no_of_male_overweight')->nullable();
            $table->integer('no_of_female_overweight')->nullable();
            $table->integer('no_of_obese')->nullable();
            $table->integer('no_of_male_obese')->nullable();
            $table->integer('no_of_female_obese')->nullable();
            $table->integer('no_of_malnourished_pupils')->nullable();
            $table->integer('no_of_male_malnourished_pupils')->nullable();
            $table->integer('no_of_female_malnourished_pupils')->nullable();
            $table->enum('is_approved', ['0', '1']);
            $table->date('approved_date')->nullable();
            $table->enum('is_deleted', ['0', '1']);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('school_id')->references('id')->on('schools_table');
            $table->foreign('school_nurse_id')->references('id')->on('users');
            $table->foreign('schoolyear_id')->references('id')->on('school_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraints first
        Schema::table('cnsr_list', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropForeign(['school_nurse_id']);
            $table->dropForeign(['schoolyear_id']);
        });

        // Now, drop the 'nsr_list' table
        Schema::dropIfExists('cnsr_list');
    }
};