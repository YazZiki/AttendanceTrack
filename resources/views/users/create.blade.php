@extends('layouts.module')

@section('title', 'Add New User')

@section('content')
    <div class="mb-4">
        <h1 class="font-headline fw-bold fs-3 mb-1">Add New User</h1>
        <p class="mb-0" style="color: var(--ec-on-surface-variant);">Create a new user account and assign permissions.</p>
    </div>
    <div class="ec-card p-4">
        @include('users.form', [
            'action'      => route('users.store'), 
            'method'      => 'POST', 
            'submitLabel' => 'Create User'
        ])
    </div>
@endsection