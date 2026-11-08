<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $lectures = Lecture::with(['course', 'section', 'instructor'])
            ->withCount('attendances')
            ->latest('lecture_date')
            ->get();

        return view('attendance.index', compact('lectures'));
    }

    public function create(): View
    {
        return view('attendance.lectures.create', $this->lectureFormData());
    }

    public function store(Request $request): RedirectResponse
    {
        $lecture = Lecture::create($this->validatedLectureData($request));

        return redirect()->route('attendance.lectures.show', $lecture)
            ->with('success', 'Lecture created successfully.');
    }

    public function show(Lecture $lecture): View
    {
        $lecture->load(['course', 'section', 'instructor', 'attendances.student']);

        return view('attendance.lectures.show', compact('lecture'));
    }

    public function edit(Lecture $lecture): View
    {
        return view('attendance.lectures.edit', array_merge(
            ['lecture' => $lecture],
            $this->lectureFormData(),
        ));
    }

    public function update(Request $request, Lecture $lecture): RedirectResponse
    {
        $lecture->update($this->validatedLectureData($request));

        return redirect()->route('attendance.lectures.show', $lecture)
            ->with('success', 'Lecture updated successfully.');
    }

    public function destroy(Lecture $lecture): RedirectResponse
    {
        $lecture->delete();

        return redirect()->route('attendance.dashboard')
            ->with('success', 'Lecture deleted successfully.');
    }

    public function records(): View
    {
        $records = Attendance::with(['lecture.course', 'student'])
            ->latest('recorded_at')
            ->get();

        return view('attendance.records.index', compact('records'));
    }

    public function createRecord(): View
    {
        return view('attendance.records.create', $this->recordFormData());
    }

    public function storeRecord(Request $request): RedirectResponse
    {
        $record = Attendance::create($this->validatedRecordData($request));

        return redirect()->route('attendance.records.show', $record)
            ->with('success', 'Attendance record created successfully.');
    }

    public function showRecord(Attendance $record): View
    {
        $record->load(['lecture.course', 'lecture.section', 'student']);

        return view('attendance.records.show', compact('record'));
    }

    public function editRecord(Attendance $record): View
    {
        return view('attendance.records.edit', array_merge(
            ['record' => $record],
            $this->recordFormData(),
        ));
    }

    public function updateRecord(Request $request, Attendance $record): RedirectResponse
    {
        $record->update($this->validatedRecordData($request, $record));

        return redirect()->route('attendance.records.show', $record)
            ->with('success', 'Attendance record updated successfully.');
    }

    public function destroyRecord(Attendance $record): RedirectResponse
    {
        $record->delete();

        return redirect()->route('attendance.records.index')
            ->with('success', 'Attendance record deleted successfully.');
    }


    private function lectureFormData(): array
    {
        return [
            'courses' => Course::query()->orderBy('course_name')->get(),
            'sections' => Section::query()->with('course')->orderBy('section_name')->get(),
            'instructors' => User::query()->orderBy('full_name')->get(),
        ];
    }


    private function recordFormData(): array
    {
        return [
            'lectures' => Lecture::query()->with('course')->latest('lecture_date')->get(),
            'students' => Student::query()->orderBy('full_name')->get(),
        ];
    }


    private function validatedLectureData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'lecture_date' => ['required', 'date'],
            'lecture_time' => ['required', 'date_format:H:i'],
            'duration' => ['required', 'integer', 'min:1'],
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'instructor_id' => ['required', 'integer', 'exists:users,id'],
        ]);
    }


    private function validatedRecordData(Request $request, ?Attendance $record = null): array
    {
        $uniqueAttendance = Rule::unique('attendance')
            ->where(fn($query) => $query->where('lecture_id', $request->integer('lecture_id')));

        if ($record !== null) {
            $uniqueAttendance = $uniqueAttendance->ignore($record->id);
        }

        return $request->validate([
            'lecture_id' => ['required', 'integer', 'exists:lectures,id'],
            'student_id' => ['required', 'integer', 'exists:students,id', $uniqueAttendance],
            'status' => ['required', Rule::in(['present', 'absent', 'late', 'excused'])],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
