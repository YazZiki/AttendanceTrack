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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->index()->constrained('lectures')->restrictOnDelete();
            $table->foreignId('student_id')->index()->constrained('students')->restrictOnDelete();
            $table->enum('status', ['present', 'absent', 'late', 'excused']);
            $table->string('notes', 255)->nullable();
            $table->timestamp('recorded_at')->useCurrent();

            // Composite UNIQUE constraint to prevent duplicate attendance per lecture
            $table->unique(['lecture_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
