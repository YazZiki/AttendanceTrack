<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    // Show the unified login view
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Basic validation: username and password are required
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Step 3: Check if username exists in database
        $user = User::with(['role', 'department'])
                    ->where('username', $request->username)
                    ->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Account not found.');
        }

        // Step 4: Verify hashed password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->with('error', 'Incorrect password.');
        }

        // Step 5: Verify account status is active
        if ($user->status !== 'active') {
            return back()->withInput()->with('error', 'Your account is disabled. Please contact the administrator.');
        }

        // Step 7: Redirect to the user's assigned Module Dashboard based on department_id
        return match ($user->department_id) {
            1 => redirect()->route('users.dashboard'),
            2 => redirect()->route('courses.dashboard'),
            3 => redirect()->route('students.dashboard'),
            4 => redirect()->route('attendance.dashboard'),
            5 => redirect()->route('exams.dashboard'),
            default => back()->with('error', 'No module dashboard assigned to this department.'),
        };
    }

    // Handle logout
    public function logout()
    {
        return redirect()->route('login');
    }
}