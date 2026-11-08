@extends('layouts.module')

@section('title', $lecture->title)
@section('module-name', 'Attendance & Lectures')
@section('module-number', 'Module 4')
@section('active-attendance', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-end gap-3 mb-4"><div><div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Lecture Details</div><h1 class="font-headline fw-bold fs-3 mb-1">{{ $lecture->title }}</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">{{ $lecture->lecture_date?->format('Y-m-d') }} at {{ $lecture->lecture_time }}</p></div><div class="d-flex gap-2"><a href="{{ route('attendance.lectures.edit', $lecture) }}" class="btn btn-ec-primary">Edit</a><a href="{{ route('attendance.dashboard') }}" class="btn btn-ec-light">Back</a></div></div>
<div class="row g-3">
    <div class="col-12 col-lg-5"><div class="ec-card p-4"><h2 class="font-headline fs-5 mb-3">Lecture Information</h2><dl class="row mb-0"><dt class="col-sm-5">Course</dt><dd class="col-sm-7">{{ $lecture->course?->course_name ?? 'Not assigned' }}</dd><dt class="col-sm-5">Section</dt><dd class="col-sm-7">{{ $lecture->section?->section_name ?? 'Not assigned' }}</dd><dt class="col-sm-5">Instructor</dt><dd class="col-sm-7">{{ $lecture->instructor?->full_name ?? 'Not assigned' }}</dd><dt class="col-sm-5">Duration</dt><dd class="col-sm-7">{{ $lecture->duration }} minutes</dd></dl></div></div>
    <div class="col-12 col-lg-7"><div class="ec-card p-4"><div class="d-flex justify-content-between align-items-center mb-3"><h2 class="font-headline fs-5 mb-0">Attendance Sheet</h2><a href="{{ route('attendance.records.create', ['lecture_id' => $lecture->id]) }}" class="btn btn-sm btn-ec-primary">Add Record</a></div><div class="table-responsive"><table class="table table-ec mb-0"><thead><tr><th>Student</th><th>Status</th><th>Actions</th></tr></thead><tbody>@forelse ($lecture->attendances as $record)<tr><td>{{ $record->student?->full_name ?? 'Unknown student' }}</td><td>{{ ucfirst($record->status) }}</td><td><a href="{{ route('attendance.records.show', $record) }}" class="btn btn-sm btn-ec-light">View</a></td></tr>@empty<tr><td colspan="3" class="text-center py-4">No attendance records.</td></tr>@endforelse</tbody></table></div></div></div>
</div>
@endsection
