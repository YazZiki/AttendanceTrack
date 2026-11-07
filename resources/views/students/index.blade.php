@extends('layouts.module')

@section('title', 'Students')
@section('module-name', 'Students & Sections')
@section('module-number', 'Module 3')
@section('active-students', 'active')

@section('content')
<div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4">
    <div>
        <div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Student Affairs</div>
        <h1 class="font-headline fw-bold fs-3 mb-1">Student Directory</h1>
        <p class="mb-0" style="color: var(--ec-on-surface-variant);">Manage registered students and their academic information.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('students.sections.index') }}" class="btn btn-ec-light">View Sections</a>
        <a href="{{ route('students.create') }}" class="btn btn-ec-primary"><span class="material-symbols-outlined me-1" style="font-size: 18px;">add</span>Add Student</a>
    </div>
</div>
<div class="ec-card p-3">
    <div class="table-responsive">
        <table class="table table-ec mb-0">
            <thead><tr><th>Name</th><th>University ID</th><th>National ID</th><th>Major</th><th>Year</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse ($students as $student)
                <tr>
                    <td class="fw-semibold">{{ $student->full_name }}</td>
                    <td>{{ $student->university_id }}</td>
                    <td>{{ $student->national_id }}</td>
                    <td>{{ $student->department?->department_name ?? 'N/A' }}</td>
                    <td>{{ $student->academic_year }}</td>
                    <td class="text-end">
                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-ec-light">View</a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-ec-light">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-4">No students found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
