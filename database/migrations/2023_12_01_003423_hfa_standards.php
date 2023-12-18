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
        Schema::create('hfa_standards', function (Blueprint $table) {
            $table->id();
            $table->integer('age');
            $table->enum('sex', ['Male', 'Female']);
            $table->decimal('negative_thirdSD', 5, 2);
            $table->decimal('negative_secondSD', 5, 2);
            $table->decimal('negative_firstSD', 5, 2);
            $table->decimal('median', 5, 2);
            $table->decimal('firstSD', 5, 2);
            $table->decimal('secondSD', 5, 2);
            $table->decimal('thirdSD', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hfa_standards');
    }
};
