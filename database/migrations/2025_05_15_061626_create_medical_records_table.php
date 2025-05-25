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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->text('complain');
            $table->text('examination');
            $table->text('diagnosis');
            $table->text('lab_test')->nullable();
            $table->string('lab_test_path')->nullable();
            $table->string('rad_test')->nullable();
            $table->string('rad_test_path')->nullable();
            $table->string('treatment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
