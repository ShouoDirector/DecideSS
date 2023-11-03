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
        Schema::create('districts_table', function (Blueprint $table) {
            $table->id();
            $table->string('district', 50)->unique();
            $table->bigInteger('medical_officer_id')->unsigned()->unique();
            $table->enum('is_deleted', [0, 1])->default(0);
            $table->timestamps();

            // Adding foreign key constraint
            $table->foreign('medical_officer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Dropping the foreign key constraint before dropping the table
        Schema::table('districts_table', function (Blueprint $table) {
            $table->dropForeign(['medical_officer_id']);
        });

        Schema::dropIfExists('districts_table');
    }
};
