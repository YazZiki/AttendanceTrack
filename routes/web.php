<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Section;
use App\Models\Lecture;
use App\Models\Attendance;
use App\Models\Exam;
use App\Models\Grade;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
Route::prefix('users-module')->name('users.')->group(function () {
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
Route::prefix('courses-module')->name('courses.')->group(function () {
    // Module 2 Dashboard
    Route::get('/dashboard', function () {
        return Course::with(['department', 'instructor', 'semester', 'prerequisite'])->get();
    })->name('dashboard');

    // View Single Course with its Sections and Lectures
    Route::get('/{id}', function ($id) {
        return Course::with(['department', 'instructor', 'semester', 'sections', 'lectures'])->findOrFail($id);
    })->name('show');

    // Manage Departments & Semesters
    Route::get('/departments/list', function () {
        return [
            'departments' => Department::all(),
            'semesters'   => Semester::all(),
        ];
    })->name('departments');
});


/*
|--------------------------------------------------------------------------
| Module 3: Student & Section Management (إدارة الطلاب والشعب) Hamza's part
|--------------------------------------------------------------------------
*/
Route::prefix('students-module')->name('students.')->group(function () {
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
});


/*
|--------------------------------------------------------------------------
| Module 4: Attendance & Lecture Management (تسجيل الحضور والغياب) Hussin's part
|--------------------------------------------------------------------------
*/
Route::prefix('attendance-module')->name('attendance.')->group(function () {
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
Route::prefix('exams-module')->name('exams.')->group(function () {
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