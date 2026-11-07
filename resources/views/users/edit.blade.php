@extends('layouts.module')

@section('title', 'Edit User')

@section('content')
    <div class="mb-4">
        <h1 class="font-headline fw-bold fs-3 mb-1">Edit User</h1>
        <p class="mb-0" style="color: var(--ec-on-surface-variant);">Update account settings for {{ $user->full_name }}.</p>
    </div>
    <div class="ec-card p-4">
        @include('users.form', [
            'action'      => route('users.update', $user), 
            'method'      => 'PUT', 
            'submitLabel' => 'Save Changes'
        ])
    </div>
@endsection