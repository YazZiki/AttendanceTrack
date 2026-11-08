@extends('layouts.module')

@section('title', 'Attendance & Lectures')
@section('module-name', 'Attendance & Lectures')
@section('module-number', 'Module 4')
@section('active-attendance', 'active')

@section('content')
<div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4">
    <div>
        <div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Attendance Management</div>
        <h1 class="font-headline fw-bold fs-3 mb-1">Lectures Directory</h1>
        <p class="mb-0" style="color: var(--ec-on-surface-variant);">Manage lectures and their attendance sheets.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('attendance.records.index') }}" class="btn btn-ec-light">Attendance Records</a>
        <a href="{{ route('attendance.lectures.create') }}" class="btn btn-ec-primary">Add Lecture</a>
    </div>
</div>
<div class="ec-card p-3">
    <div class="table-responsive">
        <table class="table table-ec mb-0">
            <thead><tr><th>Title</th><th>Date</th><th>Course</th><th>Section</th><th>Records</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse ($lectures as $lecture)
                <tr>
                    <td class="fw-semibold">{{ $lecture->title }}</td>
                    <td>{{ $lecture->lecture_date?->format('Y-m-d') }}</td>
                    <td>{{ $lecture->course?->course_name ?? 'Not assigned' }}</td>
                    <td>{{ $lecture->section?->section_name ?? 'Not assigned' }}</td>
                    <td>{{ $lecture->attendances_count }}</td>
                    <td class="text-end">
                        <a href="{{ route('attendance.lectures.show', $lecture) }}" class="btn btn-sm btn-ec-light">View</a>
                        <a href="{{ route('attendance.lectures.edit', $lecture) }}" class="btn btn-sm btn-ec-light">Edit</a>
                        <form action="{{ route('attendance.lectures.destroy', $lecture) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this lecture?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4">No lectures found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
