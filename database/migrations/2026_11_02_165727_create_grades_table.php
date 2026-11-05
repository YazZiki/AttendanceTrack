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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->index()->constrained('exams')->restrictOnDelete();
            $table->foreignId('student_id')->index()->constrained('students')->restrictOnDelete();
            $table->decimal('grade', 5, 2);
            $table->date('recorded_date');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            // Composite UNIQUE constraint to prevent duplicate grade per exam
            $table->unique(['exam_id', 'student_id']);
        });
        // Enforces CHECK (grade >= 0); comparing against exams.max_grade is handled in Laravel Validation
        DB::statement('ALTER TABLE grades ADD CONSTRAINT chk_grade_non_negative CHECK (grade >= 0);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
