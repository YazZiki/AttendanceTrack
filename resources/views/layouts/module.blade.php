<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Academic Module') - AttendanceTrack</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/UserDashboard.css') }}"/>
</head>
<body>
<aside class="ec-sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="d-flex align-items-center gap-2 px-4" style="height: 64px;">
            <span class="material-symbols-outlined fs-3" style="color: var(--ec-primary);">school</span>
            <span class="font-headline fw-bold fs-5" style="color: var(--ec-primary);">EduCore</span>
        </div>
        <div class="px-3 py-2">
            <span class="px-2 text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.05em; color: var(--ec-outline);">Academic System</span>
        </div>
        <nav class="d-flex flex-column gap-1 px-3">
            <a href="{{ route('users.dashboard') }}" class="ec-nav-link"><span class="material-symbols-outlined">group</span><span>User Management</span></a>
            <a href="{{ route('courses.dashboard') }}" class="ec-nav-link @yield('active-module')"><span class="material-symbols-outlined">menu_book</span><span>Classrooms & Courses</span></a>
            <a href="{{ route('students.dashboard') }}" class="ec-nav-link @yield('active-students')"><span class="material-symbols-outlined">badge</span><span>Students & Sections</span></a>
            <a href="{{ route('attendance.dashboard') }}" class="ec-nav-link"><span class="material-symbols-outlined">fact_check</span><span>Attendance & Lectures</span></a>
            <a href="{{ route('exams.dashboard') }}" class="ec-nav-link"><span class="material-symbols-outlined">grading</span><span>Exams & Grades</span></a>
        </nav>
    </div>
    <div class="p-3 m-3 rounded-3 bg-white shadow-sm">
        <div class="d-flex align-items-center gap-1 mb-1" style="color: var(--ec-secondary);">
            <span class="material-symbols-outlined" style="font-size: 18px;">verified</span>
            <span class="fw-semibold" style="font-size: 11px;">Institutional Tier</span>
        </div>
        <p class="mb-2" style="font-size: 12px; color: var(--ec-on-surface-variant);">AIU AttendanceTrack System</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link p-0 text-decoration-none fw-semibold" style="font-size: 12px; color: var(--ec-error);">Sign Out</button>
        </form>
    </div>
</aside>
<div class="ec-main-wrapper">
    <header class="ec-header d-flex align-items-center justify-content-between px-4">
        <span class="fw-semibold">@yield('module-name', 'Academic Module')</span>
        <span class="badge badge-surface">@yield('module-number', 'Module')</span>
    </header>
    <main class="ec-content container-fluid px-4">
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
