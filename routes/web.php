<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Department;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Lecture;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Shared Authentication Routes (Unified Login & Logout)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Module 1: User & Permission Management (إدارة المستخدمين والصلاحيات) Yazan's part
|--------------------------------------------------------------------------
*/
Route::prefix('users-module')->name('users.')->middleware('department:1')->group(function () {
    // Module 1 Dashboard
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::get('/roles/list', [UserController::class, 'roles'])->name('roles');
});

/*
|--------------------------------------------------------------------------
| Module 2: Course & Curriculum Management (إدارة المواد والمقررات) Khalil's part
|--------------------------------------------------------------------------
*/
Route::prefix('courses-module')->name('courses.')->middleware('department:2')->group(function () {
    Route::get('/dashboard', [CourseController::class, 'index'])->name('dashboard');
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/', [CourseController::class, 'store'])->name('store');
    Route::get('/departments/list', function () {
        return [
            'departments' => Department::all(),
            'semesters' => Semester::all(),
        ];
    })->name('departments');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
    Route::put('/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Module 3: Student & Section Management (إدارة الطلاب والشعب) Hamza's part
|--------------------------------------------------------------------------
*/
<<<<<<< HEAD
Route::prefix('students-module')->name('students.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/', [StudentController::class, 'store'])->name('store');
=======
Route::prefix('students-module')->name('students.')->middleware('department:3')->group(function () {
    // Module 3 Dashboard
    Route::get('/dashboard', function () {
        return Student::with('department')->get();
    })->name('dashboard');

    // View Student Profile with Enrolled Sections, Attendance, and Grades
    Route::get('/{id}', function ($id) {
        return Student::with(['department', 'sections.course', 'attendances.lecture', 'grades.exam'])->findOrFail($id);
    })->name('show');

    // View Sections & Enrolled Students
    Route::get('/sections/list', function () {
        return Section::with(['course', 'instructor', 'semester', 'students'])->get();
    })->name('sections');
>>>>>>> 27fcdfab648fe664ead0b0efbcf59ebe2af03b5a
});

Route::prefix('students-module/sections')->name('sections.')->group(function () {
    Route::get('/', [SectionController::class, 'index'])->name('index');
    Route::get('/create', [SectionController::class, 'create'])->name('create');
    Route::post('/', [SectionController::class, 'store'])->name('store');
    Route::get('/{section}', [SectionController::class, 'show'])->name('show');
    Route::get('/{section}/edit', [SectionController::class, 'edit'])->name('edit');
    Route::put('/{section}', [SectionController::class, 'update'])->name('update');
    Route::delete('/{section}', [SectionController::class, 'destroy'])->name('destroy');
});

    // Individual Student Actions (Must be below static routes like /create or /sections)
    Route::get('/{student}', [StudentController::class, 'show'])->name('show');
    Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');
    Route::put('/{student}', [StudentController::class, 'update'])->name('update');
    Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Module 4: Attendance & Lecture Management (تسجيل الحضور والغياب) Hussin's part
|--------------------------------------------------------------------------
*/
Route::prefix('attendance-module')->name('attendance.')->middleware('department:4')->group(function () {
    // Module 4 Dashboard (Lectures List)
    Route::get('/dashboard', function () {
        return Lecture::with(['course', 'section', 'instructor'])->get();
    })->name('dashboard');

    // View Single Lecture Details with Attendance Sheet
    Route::get('/lectures/{id}', function ($id) {
        return Lecture::with(['course', 'section', 'instructor', 'attendances.student'])->findOrFail($id);
    })->name('lectures.show');

    // Attendance Records List
    Route::get('/records', function () {
        return Attendance::with(['lecture', 'student'])->get();
    })->name('records');
});

/*
|--------------------------------------------------------------------------
| Module 5: Exams & Grades Management (إدارة الامتحانات والدرجات) Ward's part
|--------------------------------------------------------------------------
*/
Route::prefix('exams-module')->name('exams.')->middleware('department:5')->group(function () {
    // Module 5 Dashboard (Exams List)
    Route::get('/dashboard', function () {
        return Exam::with(['examType', 'course', 'section'])->get();
    })->name('dashboard');

    // View Single Exam with Student Grades
    Route::get('/{id}', function ($id) {
        return Exam::with(['examType', 'course', 'section', 'grades.student'])->findOrFail($id);
    })->name('show');

    // Final Grades Report
    Route::get('/grades/report', function () {
        return Grade::with(['student', 'exam.course', 'exam.examType'])->get();
    })->name('grades.report');
});
