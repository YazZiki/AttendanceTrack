@extends('layouts.module')
@section('title', 'Edit Exam')
@section('content')
<div class="mb-4">
    <h1 class="font-headline fw-bold fs-3 mb-1">Edit Exam Schedule</h1>
    <p class="mb-0 text-secondary">Update details for {{ $exam->examType?->type_name }} - {{ $exam->course?->course_name }}.</p>
</div>
<div class="ec-card p-4">
    @include('exams.form', ['action' => route('exams.update', $exam), 'method' => 'PUT', 'submitLabel' => 'Save Changes'])
</div>
@endsection