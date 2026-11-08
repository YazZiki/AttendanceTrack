@extends('layouts.module')

@section('title', 'Exams Dashboard')

@section('content')
<div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4">
    <div>
        <div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Module 5 • Examinations</div>
        <h1 class="font-headline fw-bold fs-3 mb-1">Scheduled Exams</h1>
        <p class="mb-0 text-secondary">Manage university examinations, halls, and enter grades.</p>
    </div>
    <div class="d-flex gap-2">
        <!-- Switch Toggle Button -->
        <a href="{{ route('exams.grades.report') }}" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 18px;">bar_chart</span>
            View Grades Report
        </a>
        <a href="{{ route('exams.create') }}" class="btn btn-ec-primary d-inline-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
            Schedule Exam
        </a>
    </div>
</div>

<div class="ec-card p-3">
    <div class="table-responsive">
        <table class="table table-ec mb-0 align-middle">
            <thead>
                <tr>
                    <th>Type & Course</th>
                    <th>Section</th>
                    <th>Date & Time</th>
                    <th>Room</th>
                    <th>Grading Scale</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($exams as $exam)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $exam->examType?->type_name }}</div>
                        <div class="small text-secondary">{{ $exam->course?->course_name }} ({{ $exam->course?->course_code }})</div>
                    </td>
                    <td>Section #{{ $exam->section_id }}</td>
                    <td>
                        <div>{{ $exam->exam_date }}</div>
                        <div class="small text-secondary">{{ $exam->exam_time }} ({{ $exam->duration }} mins)</div>
                    </td>
                    <td>{{ $exam->room ?? 'N/A' }}</td>
                    <td>Max: {{ $exam->max_grade }} | Min: {{ $exam->min_grade }}</td>
                    <td class="text-end">
                        <a href="{{ route('exams.show', $exam) }}" class="btn btn-sm btn-ec-light">Grading Sheet</a>
                        <a href="{{ route('exams.edit', $exam) }}" class="btn btn-sm btn-ec-light">Edit</a>
                        <form action="{{ route('exams.destroy', $exam) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete exam schedule?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4 text-secondary">No exams scheduled.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection