<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 1. Show the unified login view
    public function showLogin()
    {
        // Optional: If already logged in, redirect straight to their dashboard
        if (session()->has('user_id')) {
            return $this->redirectByDepartment(session('department_id'));
        }

        return view('auth.login');
    }

    // 2. Handle login form submission
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withInput()->with('error', 'Invalid username or password.');
        }

        if ($user->status !== 'active') {
            return back()->withInput()->with('error', 'Your account is disabled.');
        }

        // Save user_id and department_id in the Session for CheckDepartment middleware
        session([
            'user_id'       => $user->id,
            'full_name'     => $user->full_name,
            'department_id' => $user->department_id,
        ]);

        return $this->redirectByDepartment($user->department_id);
    }

    // 3. Handle logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }

    // Helper method to route by department_id (1 to 5)
    private function redirectByDepartment($departmentId)
    {
        return match ((int) $departmentId) {
            1 => redirect()->route('users.dashboard'),
            2 => redirect()->route('courses.dashboard'),
            3 => redirect()->route('students.dashboard'),
            4 => redirect()->route('attendance.dashboard'),
            5 => redirect()->route('exams.dashboard'),
            default => redirect()->route('login')->with('error', 'No module assigned to this department.'),
        };
    }
}