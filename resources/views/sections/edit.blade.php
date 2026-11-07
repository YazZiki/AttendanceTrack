@extends('layouts.module')

@section('title', 'Edit Section')

@section('content')
    <div class="mb-4">
        <h1 class="font-headline fw-bold fs-3 mb-1">Edit Section</h1>
        <p class="mb-0" style="color: var(--ec-on-surface-variant);">Update {{ $section->section_name }}.</p>
    </div>
    <div class="ec-card p-4">
        @include('sections.form', ['action' => route('students.sections.update', $section), 'method' => 'PUT', 'submitLabel' => 'Save Changes'])
    </div>
@endsection