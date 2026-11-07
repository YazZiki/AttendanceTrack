<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ config('app.name', 'AttendanceTrack') }} - Unified Login</title>
    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="d-flex align-items-center justify-content-center py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-8">
            <div class="login-card row g-0">
                
                <!-- Left Branding Panel -->
                <div class="col-md-5 login-brand-side p-4 p-lg-5 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="material-symbols-outlined fs-2">school</span>
                            <span class="font-headline fw-bold fs-4 tracking-tight">AttendanceTrack</span>
                        </div>
                        <span class="badge badge-tier rounded-pill px-3 py-1 mb-3 d-inline-flex align-items-center gap-1">
                            <span class="material-symbols-outlined" style="font-size: 15px;">verified</span>
                            AIU Academic Portal
                        </span>
                        <h2 class="font-headline fw-bold fs-3 mt-2">Unified Lecture & Attendance System</h2>
                        <p class="small text-white-50 mt-2">
                            Sign in with your university credentials. You will be automatically directed to your assigned department module.
                        </p>
                    </div>
                    <div class="small text-white-50 mt-4 pt-3 border-top border-white border-opacity-10">
                        <div>Arab International University</div>
                        <div>Faculty of Informatics Engineering • WP2</div>
                    </div>
                </div>

                <!-- Right Login Form Panel -->
                <div class="col-md-7 p-4 p-lg-5 bg-white">
                    <div class="mb-4">
                        <div class="text-uppercase fw-semibold small mb-1" style="color: var(--ec-primary); letter-spacing: 0.05em; font-size: 11px;">
                            Authentication Portal
                        </div>
                        <h1 class="font-headline fw-bold fs-3 mb-1">Welcome Back</h1>
                        <p class="text-secondary small mb-0">Enter your username and password to access your dashboard.</p>
                    </div>

                    <!-- Display Session Error Alert -->
                    @if(session('error'))
                        <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 border-0 rounded-3 small" style="background-color: #ffdad6; color: #93000a;">
                            <span class="material-symbols-outlined">error</span>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Display Validation Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger py-2 px-3 border-0 rounded-3 small" style="background-color: #ffdad6; color: #93000a;">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.submit') }}" method="POST" class="mt-4">
                        @csrf

                        <!-- Username Field -->
                        <div class="mb-3">
                            <label for="username" class="form-label small fw-semibold">Username</label>
                            <div class="position-relative">
                                <span class="material-symbols-outlined position-absolute top-50 translate-middle-y ms-3 text-secondary">person</span>
                                <input type="text"
                                       id="username"
                                       name="username"
                                       value="{{ old('username') }}"
                                       class="form-control form-control-ec"
                                       {{-- placeholder="e.g. admin_mgr or courses_mgr" --}}
                                       required
                                       autofocus/>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label small fw-semibold">Password</label>
                            <div class="position-relative">
                                <span class="material-symbols-outlined position-absolute top-50 translate-middle-y ms-3 text-secondary">lock</span>
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-control form-control-ec"
                                       {{-- placeholder="Enter your password" --}}
                                       required/>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-ec-primary w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                            <span>Sign In to Dashboard</span>
                            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
                        </button>
                    </form>

                    <!-- Quick Test Credentials Helper for Demo -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="small fw-semibold text-secondary mb-2" style="font-size: 12px;">Demo Accounts (Password: <code>Password123</code>):</div>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge rounded-pill text-dark" style="background-color: var(--ec-surface-container); font-weight: 500;">admin_mgr (Mod 1)</span>
                            <span class="badge rounded-pill text-dark" style="background-color: var(--ec-surface-container); font-weight: 500;">courses_mgr (Mod 2)</span>
                            <span class="badge rounded-pill text-dark" style="background-color: var(--ec-surface-container); font-weight: 500;">students_mgr (Mod 3)</span>
                            <span class="badge rounded-pill text-dark" style="background-color: var(--ec-surface-container); font-weight: 500;">instructor_mgr (Mod 4)</span>
                            <span class="badge rounded-pill text-dark" style="background-color: var(--ec-surface-container); font-weight: 500;">exams_mgr (Mod 5)</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>