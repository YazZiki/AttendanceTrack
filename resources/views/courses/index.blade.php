@extends('layouts.module')

@section('title', 'Courses')
@section('module-name', 'Courses & Curriculum')
@section('module-number', 'Module 2')
@section('active-module', 'active')

@section('content')
<div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4">
    <div>
        <div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Course Management</div>
        <h1 class="font-headline fw-bold fs-3 mb-1">Course Directory</h1>
        <p class="mb-0" style="color: var(--ec-on-surface-variant);">Manage courses and curriculum information.</p>
    </div>
    <a href="{{ route('courses.create') }}" class="btn btn-ec-primary"><span class="material-symbols-outlined me-1" style="font-size: 18px;">add</span>Add Course</a>
</div>
<div class="ec-card p-3">
    <div class="table-responsive">
        <table class="table table-ec mb-0">
            <thead><tr><th>Course</th><th>Code</th><th>Credit Hours</th><th>Department</th><th>Instructor</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse ($courses as $course)
                <tr>
                    <td class="fw-semibold">{{ $course->course_name }}</td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->credit_hours }}</td>
                    <td>{{ $course->department?->department_name ?? 'Not assigned' }}</td>
                    <td>{{ $course->instructor?->full_name ?? 'Not assigned' }}</td>
                    <td class="text-end">
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-ec-light">View</a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-ec-light">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this course?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4">No courses found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
