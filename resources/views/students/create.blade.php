@extends('layouts.module')

@section('title', 'Add Student')

@section('content')
<div class="mb-4"><h1 class="font-headline fw-bold fs-3 mb-1">Add Student</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">Create a new student record.</p></div>
<div class="ec-card p-4">
    @include('students.form', ['action' => route('students.store'), 'method' => 'POST', 'submitLabel' => 'Create Student'])
</div>
@endsection
