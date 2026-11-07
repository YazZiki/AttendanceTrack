@extends('layouts.module')

@section('title', 'Add Course')
@section('module-name', 'Courses & Curriculum')
@section('module-number', 'Module 2')
@section('active-module', 'active')

@section('content')
<div class="mb-4"><h1 class="font-headline fw-bold fs-3 mb-1">Add Course</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">Create a new course record.</p></div>
<div class="ec-card p-4">
    @include('courses.form', ['action' => route('courses.store'), 'method' => 'POST', 'submitLabel' => 'Create Course'])
</div>
@endsection
