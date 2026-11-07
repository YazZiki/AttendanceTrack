@extends('layouts.module')

@section('title', $course->course_name)
@section('module-name', 'Courses & Curriculum')
@section('module-number', 'Module 2')
@section('active-module', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-end gap-3 mb-4"><div><div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Course Details</div><h1 class="font-headline fw-bold fs-3 mb-1">{{ $course->course_name }}</h1><p class="mb-0" style="color: var(--ec-on-surface-variant);">{{ $course->course_code }}</p></div><div class="d-flex gap-2"><a href="{{ route('courses.edit', $course) }}" class="btn btn-ec-primary">Edit</a><a href="{{ route('courses.index') }}" class="btn btn-ec-light">Back</a></div></div>
<div class="row g-3">
    <div class="col-12 col-lg-6"><div class="ec-card p-4"><h2 class="font-headline fs-5 mb-3">Course Information</h2><dl class="row mb-0"><dt class="col-sm-5">Course code</dt><dd class="col-sm-7">{{ $course->course_code }}</dd><dt class="col-sm-5">Credit hours</dt><dd class="col-sm-7">{{ $course->credit_hours }}</dd><dt class="col-sm-5">Department</dt><dd class="col-sm-7">{{ $course->department?->department_name ?? 'Not assigned' }}</dd><dt class="col-sm-5">Instructor</dt><dd class="col-sm-7">{{ $course->instructor?->full_name ?? 'Not assigned' }}</dd><dt class="col-sm-5">Semester</dt><dd class="col-sm-7">{{ $course->semester?->semester_name ?? 'Not assigned' }}</dd><dt class="col-sm-5">Status</dt><dd class="col-sm-7">{{ ucfirst($course->status) }}</dd></dl></div></div>
    <div class="col-12 col-lg-6"><div class="ec-card p-4"><h2 class="font-headline fs-5 mb-3">Sections</h2>@forelse ($course->sections as $section)<div class="border-bottom py-2">{{ $section->section_name }}</div>@empty<p class="text-secondary mb-0">No sections assigned.</p>@endforelse</div></div>
</div>
@endsection
