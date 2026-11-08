@extends('layouts.module')

@section('title', 'Edit Lecture')
@section('module-name', 'Attendance & Lectures')
@section('module-number', 'Module 4')
@section('active-attendance', 'active')

@section('content')
<div class="mb-4"><h1 class="font-headline fw-bold fs-3 mb-1">Edit Lecture</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">Update {{ $lecture->title }}.</p></div>
<div class="ec-card p-4">
    @include('attendance.lectures.form', ['action' => route('attendance.lectures.update', $lecture), 'method' => 'PUT', 'submitLabel' => 'Save Changes'])
</div>
@endsection
