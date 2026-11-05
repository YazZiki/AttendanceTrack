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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_type_id')->constrained('exam_types')->restrictOnDelete();
            $table->date('exam_date')->index(); // Indexed per page 19
            $table->time('exam_time');
            $table->integer('duration');
            $table->decimal('max_grade', 5, 2);
            $table->decimal('min_grade', 5, 2);
            $table->foreignId('section_id')->constrained('sections')->restrictOnDelete();
            $table->foreignId('course_id')->constrained('courses')->restrictOnDelete();
            $table->string('room', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
        // Enforces CHECK constraints for duration, max_grade (10-100), and min_grade (< max_grade)
        DB::statement('ALTER TABLE exams ADD CONSTRAINT chk_exam_duration CHECK (duration > 0);');
        DB::statement('ALTER TABLE exams ADD CONSTRAINT chk_exam_grades CHECK (max_grade BETWEEN 10 AND 100 AND min_grade < max_grade);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
