@extends('layouts.module')

@section('title', 'Attendance Records')
@section('module-name', 'Attendance & Lectures')
@section('module-number', 'Module 4')
@section('active-attendance', 'active')

@section('content')
<div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4"><div><div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Attendance Management</div><h1 class="font-headline fw-bold fs-3 mb-1">Attendance Records</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">Manage student attendance for every lecture.</p></div><div class="d-flex gap-2"><a href="{{ route('attendance.dashboard') }}" class="btn btn-ec-light">View Lectures</a><a href="{{ route('attendance.records.create') }}" class="btn btn-ec-primary">Add Record</a></div></div>
<div class="ec-card p-3"><div class="table-responsive"><table class="table table-ec mb-0"><thead><tr><th>Lecture</th><th>Student</th><th>Status</th><th>Recorded At</th><th class="text-end">Actions</th></tr></thead><tbody>
@forelse ($records as $record)<tr><td>{{ $record->lecture?->title ?? 'Unknown lecture' }}</td><td class="fw-semibold">{{ $record->student?->full_name ?? 'Unknown student' }}</td><td>{{ ucfirst($record->status) }}</td><td>{{ $record->recorded_at?->format('Y-m-d H:i') }}</td><td class="text-end"><a href="{{ route('attendance.records.show', $record) }}" class="btn btn-sm btn-ec-light">View</a><a href="{{ route('attendance.records.edit', $record) }}" class="btn btn-sm btn-ec-light">Edit</a><form action="{{ route('attendance.records.destroy', $record) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this attendance record?');">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@empty<tr><td colspan="5" class="text-center py-4">No attendance records found.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
