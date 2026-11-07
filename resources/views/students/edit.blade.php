@extends('layouts.module')

@section('title', 'Edit Student')

@section('content')
    <div class="mb-4">
        <h1 class="font-headline fw-bold fs-3 mb-1">Edit Student</h1>
        <p class="mb-0" style="color: var(--ec-on-surface-variant);">Update {{ $student->full_name }}'s information.</p>
    </div>
    <div class="ec-card p-4">
        @include('students.form', ['action' => route('students.update', $student), 'method' => 'PUT', 'submitLabel' => 'Save Changes'])
    </div>
@endsection