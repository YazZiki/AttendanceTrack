@extends('layouts.module')

@section('title', 'Add Section')
@section('module-name', 'Students & Sections')
@section('module-number', 'Module 3')
@section('active-students', 'active')

@section('content')
    <div class="mb-4">
        <h1 class="font-headline fw-bold fs-3 mb-1">Add Section</h1>
        <p class="mb-0" style="color: var(--ec-on-surface-variant);">Create a course section.</p>
    </div>
    <div class="ec-card p-4">
        @include('sections.form', ['action' => route('students.sections.store'), 'method' => 'POST', 'submitLabel' => 'Create Section'])
    </div>
@endsection