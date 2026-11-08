@extends('layouts.module')

@section('title', 'Grades Report')

@section('content')
<div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4">
    <div>
        <div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Module 5 • Analytics</div>
        <h1 class="font-headline fw-bold fs-3 mb-1">University Grades Report</h1>
        <p class="mb-0 text-secondary">Comprehensive overview of all student recorded scores.</p>
    </div>
    <div class="d-flex gap-2">
        <!-- Switch Toggle Button -->
        <a href="{{ route('exams.dashboard') }}" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 18px;">event_note</span>
            View Exams List
        </a>
    </div>
</div>

<div class="ec-card p-3">
    <div class="table-responsive">
        <table class="table table-ec mb-0 align-middle">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>University ID</th>
                    <th>Course</th>
                    <th>Exam Type</th>
                    <th>Score Recorded</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($grades as $item)
                <tr>
                    <td class="fw-semibold">{{ $item->student?->full_name }}</td>
                    <td>{{ $item->student?->university_id }}</td>
                    <td>{{ $item->exam?->course?->course_name }}</td>
                    <td>{{ $item->exam?->examType?->type_name }}</td>
                    <td><strong>{{ $item->grade }}</strong> / {{ $item->exam?->max_grade }}</td>
                    <td>
                        @if($item->grade >= ($item->exam?->min_grade ?? 50))
                            <span class="badge bg-success-subtle text-success px-2 py-1">Passed</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-2 py-1">Failed</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4 text-secondary">No student grades recorded yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection