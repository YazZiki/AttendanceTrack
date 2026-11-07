@extends('layouts.module')

@section('title', 'User Directory & Management')

@section('content')
        <!-- Page Header -->
        <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-1 text-uppercase fw-semibold mb-1" style="font-size: 11px; color: var(--ec-primary); letter-spacing: 0.05em;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">school</span>
                    <span>Directory Operations</span>
                </div>
                <h1 class="font-headline fw-bold fs-3 mb-1">User Directory & Management</h1>
                <p class="mb-0" style="color: var(--ec-on-surface-variant);">
                    Manage and oversee enrolled students, faculty members, and academic staff accounts across departments.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('users.roles') }}" class="btn btn-ec-light d-inline-flex align-items-center gap-1 shadow-sm">
                    <span class="material-symbols-outlined" style="font-size: 18px;">admin_panel_settings</span>
                    <span>Manage Roles</span>
                </a>
                <a href="{{ route('users.create') }}" class="btn btn-ec-primary d-inline-flex align-items-center gap-1 shadow-sm">
                    <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                    <span>Add New User</span>
                </a>
            </div>
        </div>

        <!-- Metric Cards Grid -->
        <div class="row g-3 mb-4">
            <!-- Card 1: Total Users -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="ec-card p-3 h-100 d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <span class="text-uppercase fw-semibold" style="font-size: 11px; color: var(--ec-outline);">Total System Users</span>
                            <div class="ec-metric-value mt-1">{{ $users->count() }}</div>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: var(--ec-primary-fixed); color: var(--ec-primary);">
                            <span class="material-symbols-outlined">group</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-3">
                        <span class="badge rounded-pill badge-surface d-inline-flex align-items-center gap-1" style="color: var(--ec-primary);">
                            <span class="material-symbols-outlined" style="font-size: 14px;">trending_up</span>
                            All 5 Modules
                        </span>
                        <span style="font-size: 12px; color: var(--ec-on-surface-variant);">Seeded & Ready</span>
                    </div>
                </div>
            </div>

            <!-- Card 2: Active Users -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="ec-card p-3 h-100 d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <span class="text-uppercase fw-semibold" style="font-size: 11px; color: var(--ec-outline);">Active Accounts</span>
                            <div class="ec-metric-value mt-1">{{ $users->where('status', 'active')->count() }}</div>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: var(--ec-tertiary-fixed); color: var(--ec-tertiary);">
                            <span class="material-symbols-outlined">verified_user</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-3">
                        <span class="badge rounded-pill badge-tertiary-fixed d-inline-flex align-items-center gap-1">
                            <span class="material-symbols-outlined" style="font-size: 14px;">done_all</span>
                            Authorized
                        </span>
                        <span style="font-size: 12px; color: var(--ec-on-surface-variant);">Can sign in</span>
                    </div>
                </div>
            </div>

            <!-- Card 3: Managers -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="ec-card p-3 h-100 d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <span class="text-uppercase fw-semibold" style="font-size: 11px; color: var(--ec-outline);">Department Managers</span>
                            <div class="ec-metric-value mt-1">{{ $users->filter(fn($u) => $u->role?->role_name === 'manager')->count() }}</div>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: var(--ec-secondary-fixed); color: var(--ec-secondary);">
                            <span class="material-symbols-outlined">badge</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-3">
                        <span class="badge rounded-pill badge-secondary-fixed">Full CRUD Access</span>
                        <span style="font-size: 12px; color: var(--ec-on-surface-variant);">5 Modules</span>
                    </div>
                </div>
            </div>

            <!-- Card 4: Inactive Accounts -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="ec-card p-3 h-100 d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <span class="text-uppercase fw-semibold" style="font-size: 11px; color: var(--ec-outline);">Inactive / Disabled</span>
                            <div class="ec-metric-value mt-1">{{ $users->where('status', 'inactive')->count() }}</div>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: var(--ec-error-container); color: var(--ec-error);">
                            <span class="material-symbols-outlined">pending_actions</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-3">
                        <span class="badge rounded-pill badge-error-container">Blocked Login</span>
                        <span style="font-size: 12px; color: var(--ec-on-surface-variant);">Status filter</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Directory Card -->
        <div class="ec-card">
            <!-- Filters & Search Bar -->
            <div class="p-3 border-bottom" style="border-color: var(--ec-surface-container) !important;">
                <div class="row g-2 align-items-center">
                    <div class="col-12 col-md-5 position-relative">
                        <span class="material-symbols-outlined position-absolute top-50 translate-middle-y ms-3" style="color: var(--ec-outline); font-size: 18px;">search</span>
                        <input type="text" class="form-control ec-input ps-5" placeholder="Search by name, username, email, or phone..."/>
                    </div>
                    <div class="col-12 col-md-2">
                        <select class="form-select ec-select">
                            <option value="">Role: All</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->role_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <select class="form-select ec-select">
                            <option value="">Department: All</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <select class="form-select ec-select">
                            <option value="">Status: All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- User Data Table -->
            <div class="table-responsive">
                <table class="table table-ec mb-0">
                    <thead>
                        <tr>
                            <th>Member Name & Username</th>
                            <th>Role</th>
                            <th>Assigned Department / Module</th>
                            <th>Phone & Birth Date</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-circle">
                                            {{ strtoupper(substr($user->full_name, 0, 2)) }}
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $user->full_name }}</span>
                                            <span style="font-size: 12px; color: var(--ec-outline);">
                                                {{ '@' . $user->username }} • {{ $user->email }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($user->role?->role_name === 'manager')
                                        <span class="badge rounded-pill badge-secondary-fixed px-2 py-1">Dept Manager</span>
                                    @elseif($user->role?->role_name === 'employee')
                                        <span class="badge rounded-pill badge-primary-fixed px-2 py-1">Dept Employee</span>
                                    @else
                                        <span class="badge rounded-pill badge-surface px-2 py-1">{{ ucfirst($user->role?->role_name) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold" style="font-size: 13px;">{{ $user->department?->department_name }}</span>
                                        <span style="font-size: 12px; color: var(--ec-on-surface-variant);">Module ID #{{ $user->department_id }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span style="font-size: 13px;">{{ $user->phone }}</span>
                                        <span style="font-size: 12px; color: var(--ec-outline);">DOB: {{ $user->birth_date?->format('Y-m-d') }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($user->status === 'active')
                                        <span class="badge rounded-pill badge-tertiary-fixed px-2 py-1 d-inline-flex align-items-center gap-1">
                                            <span class="rounded-circle d-inline-block" style="width: 6px; height: 6px; background-color: var(--ec-tertiary);"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="badge rounded-pill badge-error-container px-2 py-1 d-inline-flex align-items-center gap-1">
                                            <span class="rounded-circle d-inline-block" style="width: 6px; height: 6px; background-color: var(--ec-error);"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-light p-1" title="View Details">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">visibility</span>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-light p-1" title="Edit User">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light p-1 text-danger border-0 bg-transparent" title="Delete User">
                                                <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Summary -->
            <div class="p-3 d-flex align-items-center justify-content-between border-top" style="border-color: var(--ec-surface-container) !important;">
                <span style="font-size: 12px; color: var(--ec-on-surface-variant);">
                    Showing <strong>1</strong> to <strong>{{ $users->count() }}</strong> of <strong>{{ $users->count() }}</strong> users
                </span>
            </div>
        </div>
@endsection