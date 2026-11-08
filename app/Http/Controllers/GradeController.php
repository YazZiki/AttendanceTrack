<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Exam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GradeController extends Controller
{
    // View final grades report across all exams
    public function report(): View
    {
        $grades = Grade::with(['student', 'exam.course', 'exam.examType'])->get();
        return view('exams.grades_report', compact('grades'));
    }

    // Store or update individual student grades for an exam
    public function storeOrUpdate(Request $request, Exam $exam): RedirectResponse
    {
        $validated = $request->validate([
            'grades'             => ['required', 'array'],
            'grades.*.student_id' => ['required', 'integer', 'exists:students,id'],
            'grades.*.grade'     => ['required', 'numeric', 'min:0', 'max:' . $exam->max_grade],
        ]);

        foreach ($validated['grades'] as $item) {
            Grade::updateOrCreate(
                [
                    'exam_id'    => $exam->id,
                    'student_id' => $item['student_id'],
                ],
                [
                    'grade'         => $item['grade'],
                    'recorded_date' => now(),
                ]
            );
        }

        return redirect()->route('exams.show', $exam)
            ->with('success', 'Student grades saved successfully.');
    }
}