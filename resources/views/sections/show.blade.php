@extends('layouts.module')

@section('title', $section->section_name)
@section('module-name', 'Students & Sections')
@section('module-number', 'Module 3')
@section('active-students', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-end gap-3 mb-4"><div><div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Section Details</div><h1 class="font-headline fw-bold fs-3 mb-1">{{ $section->section_name }}</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">{{ $section->course?->course_name ?? 'Course unavailable' }}</p></div><div class="d-flex gap-2"><a href="{{ route('students.sections.edit', $section) }}" class="btn btn-ec-primary">Edit</a><a href="{{ route('students.sections.index') }}" class="btn btn-ec-light">Back</a></div></div>
<div class="ec-card p-4"><h2 class="font-headline fs-5 mb-3">Enrolled Students</h2><div class="table-responsive"><table class="table table-ec mb-0"><thead><tr><th>Name</th><th>University ID</th><th>Major</th></tr></thead><tbody>@forelse ($section->students as $student)<tr><td>{{ $student->full_name }}</td><td>{{ $student->university_id }}</td><td>{{ $student->major }}</td></tr>@empty<tr><td colspan="3" class="text-center py-4">No students enrolled.</td></tr>@endforelse</tbody></table></div></div>
@endsection
