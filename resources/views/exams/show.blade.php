@extends('layouts.module')

@section('title', 'Exam Grading Sheet')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="font-headline fw-bold fs-3 mb-1">{{ $exam->examType?->type_name }}: {{ $exam->course?->course_name }}</h1>
        <p class="mb-0 text-secondary">Section #{{ $exam->section_id }} • Hall: {{ $exam->room }} • Max Score: {{ $exam->max_grade }}</p>
    </div>
    <a href="{{ route('exams.dashboard') }}" class="btn btn-ec-light">Back to Exams</a>
</div>

<div class="ec-card p-4">
    <h5 class="fw-bold mb-3">Student Score Entry Form</h5>
    
    <form action="{{ route('exams.grades.store', $exam) }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table table-ec mb-3 align-middle">
                <thead>
                    <tr>
                        <th>University ID</th>
                        <th>Student Full Name</th>
                        <th style="width: 250px;">Enter Grade (Max: {{ $exam->max_grade }})</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Fetches students enrolled in this exam's section --}}
                    @forelse ($exam->section?->students ?? [] as $index => $student)
                        @php
                            // Check if a grade is already recorded for this student
                            $existingGrade = $exam->grades->where('student_id', $student->id)->first();
                        @endphp
                        <tr>
                            <td>{{ $student->university_id }}</td>
                            <td class="fw-semibold">{{ $student->full_name }}</td>
                            <td>
                                <input type="hidden" name="grades[{{ $index }}][student_id]" value="{{ $student->id }}">
                                <input type="number" step="0.5" min="0" max="{{ $exam->max_grade }}" 
                                       name="grades[{{ $index }}][grade]" 
                                       value="{{ old('grades.'.$index.'.grade', $existingGrade->grade ?? '') }}" 
                                       class="form-control ec-input" placeholder="0.0">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-secondary">No students are currently enrolled in this section.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($exam->section?->students ?? []) > 0)
            <button type="submit" class="btn btn-ec-primary">Save All Student Grades</button>
        @endif
    </form>
</div>
@endsection