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
            $table->bigInteger('nsr_id')->unsigned()->unique();
            $table->bigInteger('pupil_id')->unsigned()->unique();
            $table->bigInteger('class_adviser_id')->unsigned()->unique();
            $table->integer('height');
            $table->integer('weight');
            $table->enum('is_dewormed', ['0', '1']);
            $table->string('dewormed_date', 255)->nullable();
            $table->enum('is_permitted_deworming', ['0', '1']);
            $table->string('explanation', 255)->nullable();
            $table->string('dietary_restriction', 255)->nullable();
            $table->enum('to_be_referred', ['0', '1']);
            $table->enum('is_deleted', ['0', '1']);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('nsr_id')->references('id')->on('nsr_list');
            $table->foreign('pupil_id')->references('id')->on('pupil');
            $table->foreign('class_adviser_id')->references('id')->on('users');
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
