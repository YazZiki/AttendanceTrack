@extends('layouts.module')

@section('title', $student->full_name)
@section('module-name', 'Students & Sections')
@section('module-number', 'Module 3')
@section('active-students', 'active')

@section('content')
<div class="d-flex justify-content-between align-items-end gap-3 mb-4"><div><div class="text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary);">Student Profile</div><h1 class="font-headline fw-bold fs-3 mb-1">{{ $student->full_name }}</h1></div><div class="d-flex gap-2"><a href="{{ route('students.edit', $student) }}" class="btn btn-ec-primary">Edit</a><a href="{{ route('students.index') }}" class="btn btn-ec-light">Back</a></div></div>
<div class="row g-3">
    <div class="col-12 col-lg-6"><div class="ec-card p-4"><h2 class="font-headline fs-5 mb-3">Student Information</h2><dl class="row mb-0"><dt class="col-sm-5">University ID</dt><dd class="col-sm-7">{{ $student->university_id }}</dd><dt class="col-sm-5">National ID</dt><dd class="col-sm-7">{{ $student->national_id }}</dd><dt class="col-sm-5">Major</dt><dd class="col-sm-7">{{ $student->major }}</dd><dt class="col-sm-5">Year</dt><dd class="col-sm-7">{{ $student->year }}</dd></dl></div></div>
    <div class="col-12 col-lg-6"><div class="ec-card p-4"><h2 class="font-headline fs-5 mb-3">Enrolled Sections</h2>@forelse ($student->sections as $section)<div class="d-flex justify-content-between border-bottom py-2"><span>{{ $section->section_name }}</span><span class="text-secondary">{{ $section->course?->course_name ?? 'Course unavailable' }}</span></div>@empty<p class="text-secondary mb-0">No enrolled sections.</p>@endforelse</div></div>
</div>
@endsection
