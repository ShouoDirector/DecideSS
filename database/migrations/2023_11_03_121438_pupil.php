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
        Schema::create('pupil', function (Blueprint $table) {
            $table->id();
            $table->string('lrn', 255);
            $table->string('last_name', 255);
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('suffix', 255)->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('barangay', 255)->nullable();
            $table->string('municipality', 255)->nullable();
            $table->string('province', 255)->nullable();
            $table->string('pupil_guardian_name', 255)->nullable();
            $table->string('pupil_guardian_contact_no', 255)->nullable();
            $table->bigInteger('added_by')->unsigned()->unique();
            $table->enum('is_deleted', [0, 1])->default(0);
            $table->timestamps();

            // Adding foreign key constraint
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pupil', function (Blueprint $table) {
            $table->dropForeign(['added_by']);
        });

        Schema::dropIfExists('pupil');
    }
};
