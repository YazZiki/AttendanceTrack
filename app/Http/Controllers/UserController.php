<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;

class UserController extends Controller
{
    // Loads the Module 1 Dashboard (users/dashboard.blade.php)
    public function index()
    {
        $users       = User::with(['role', 'department'])->get();
        $roles       = Role::all();
        $departments = Department::all();

        return view('users.dashboard', compact('users', 'roles', 'departments'));
    }

    // View single user details with activities
    public function show($id)
    {
        return User::with(['role', 'department', 'courses', 'sections', 'lectures'])->findOrFail($id);
    }

    // View roles & permissions
    public function roles()
    {
        return Role::with('permissions')->get();
    }
}