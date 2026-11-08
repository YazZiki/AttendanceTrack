@extends('layouts.module')
@section('title', 'Schedule Exam')
@section('content')
<div class="mb-4">
    <h1 class="font-headline fw-bold fs-3 mb-1">Schedule New Exam</h1>
    <p class="mb-0 text-secondary">Set up an examination date, venue, and grading bounds.</p>
</div>
<div class="ec-card p-4">
    @include('exams.form', ['action' => route('exams.store'), 'method' => 'POST', 'submitLabel' => 'Schedule Exam'])
</div>
@endsection