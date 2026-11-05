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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name', 50);
            $table->foreignId('course_id')->constrained('courses')->restrictOnDelete();
            $table->foreignId('instructor_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->restrictOnDelete();
            $table->integer('capacity');
            $table->timestamp('created_at')->useCurrent();
        });
        DB::statement('ALTER TABLE sections ADD CONSTRAINT chk_section_capacity CHECK (capacity > 0);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
