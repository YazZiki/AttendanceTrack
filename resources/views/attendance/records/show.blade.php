@extends('layouts.module')

@section('title', 'Attendance Record')
@section('module-name', 'Attendance & Lectures')
@section('module-number', 'Module 4')
@section('active-attendance', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-end gap-3 mb-4"><div><div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Attendance Record</div><h1 class="font-headline fw-bold fs-3 mb-1">{{ $record->student?->full_name ?? 'Unknown student' }}</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">{{ $record->lecture?->title ?? 'Unknown lecture' }}</p></div><div class="d-flex gap-2"><a href="{{ route('attendance.records.edit', $record) }}" class="btn btn-ec-primary">Edit</a><a href="{{ route('attendance.records.index') }}" class="btn btn-ec-light">Back</a></div></div>
<div class="ec-card p-4"><dl class="row mb-0"><dt class="col-sm-3">Lecture</dt><dd class="col-sm-9">{{ $record->lecture?->title ?? 'Unknown lecture' }}</dd><dt class="col-sm-3">Course</dt><dd class="col-sm-9">{{ $record->lecture?->course?->course_name ?? 'Not assigned' }}</dd><dt class="col-sm-3">Student</dt><dd class="col-sm-9">{{ $record->student?->full_name ?? 'Unknown student' }}</dd><dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ ucfirst($record->status) }}</dd><dt class="col-sm-3">Notes</dt><dd class="col-sm-9">{{ $record->notes ?: 'No notes' }}</dd></dl></div>
@endsection
