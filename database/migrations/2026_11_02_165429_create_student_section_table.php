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
        Schema::create('student_section', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->restrictOnDelete();
            $table->foreignId('section_id')->constrained('sections')->restrictOnDelete();
            $table->date('registration_date');
            $table->timestamp('created_at')->useCurrent();

            // Composite UNIQUE constraint to prevent duplicate enrollment
            $table->unique(['student_id', 'section_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_section');
    }
};
