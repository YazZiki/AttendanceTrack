@extends('layouts.module')

@section('title', 'Edit Attendance Record')
@section('module-name', 'Attendance & Lectures')
@section('module-number', 'Module 4')
@section('active-attendance', 'active')

@section('content')
<div class="mb-4"><h1 class="font-headline fw-bold fs-3 mb-1">Edit Attendance Record</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">Update the attendance status.</p></div>
<div class="ec-card p-4">@include('attendance.records.form', ['action' => route('attendance.records.update', $record), 'method' => 'PUT', 'submitLabel' => 'Save Changes'])</div>
@endsection
