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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->date('lecture_date')->index(); // Indexed per page 19
            $table->time('lecture_time');
            $table->integer('duration');
            $table->foreignId('section_id')->constrained('sections')->restrictOnDelete();
            $table->foreignId('course_id')->constrained('courses')->restrictOnDelete();
            $table->foreignId('instructor_id')->constrained('users')->restrictOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
        // Enforces CHECK (duration > 0)
        DB::statement('ALTER TABLE lectures ADD CONSTRAINT chk_lecture_duration CHECK (duration > 0);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
