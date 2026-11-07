@extends('layouts.module')

@section('title', 'Sections')
@section('module-name', 'Students & Sections')
@section('module-number', 'Module 3')
@section('active-students', 'active')

@section('content')
<div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4"><div><div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Academic Structure</div><h1 class="font-headline fw-bold fs-3 mb-1">Sections</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">Manage course sections and enrolled students.</p></div><div class="d-flex gap-2"><a href="{{ route('students.dashboard') }}" class="btn btn-ec-light">View Students</a><a href="{{ route('students.sections.create') }}" class="btn btn-ec-primary">Add Section</a></div></div>
<div class="ec-card p-3"><div class="table-responsive"><table class="table table-ec mb-0"><thead><tr><th>Section</th><th>Course</th><th>Students</th><th class="text-end">Actions</th></tr></thead><tbody>
@forelse ($sections as $section)<tr><td class="fw-semibold">{{ $section->section_name }}</td><td>{{ $section->course?->course_name ?? 'Course unavailable' }}</td><td>{{ $section->students->count() }}</td><td class="text-end"><a href="{{ route('students.sections.show', $section) }}" class="btn btn-sm btn-ec-light">View</a><a href="{{ route('students.sections.edit', $section) }}" class="btn btn-sm btn-ec-light">Edit</a><form action="{{ route('students.sections.destroy', $section) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this section?');">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@empty<tr><td colspan="4" class="text-center py-4">No sections found.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
