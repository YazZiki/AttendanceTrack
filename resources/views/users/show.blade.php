@extends('layouts.module')

@section('title', 'User Profile')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="font-headline fw-bold fs-3 mb-1">{{ $user->full_name }}</h1>
            <p class="mb-0 text-secondary">Account details and system profile.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-ec-primary">Edit User</a>
            <a href="{{ route('users.dashboard') }}" class="btn btn-ec-light">Back to Directory</a>
        </div>
    </div>

    <div class="ec-card p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <strong>Username:</strong> {{ '@' . $user->username }}
            </div>
            <div class="col-md-6">
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div class="col-md-6">
                <strong>Phone:</strong> {{ $user->phone }}
            </div>
            <div class="col-md-6">
                <strong>Birth Date:</strong> {{ $user->birth_date?->format('Y-m-d') }}
            </div>
            <div class="col-md-6">
                <strong>Role:</strong> {{ ucfirst($user->role?->role_name) }}
            </div>
            <div class="col-md-6">
                <strong>Department:</strong> {{ $user->department?->department_name }}
            </div>
            <div class="col-md-6">
                <strong>Status:</strong> {{ ucfirst($user->status) }}
            </div>
        </div>
    </div>
@endsection