<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    // Loads the Module 1 Dashboard (users/index.blade.php)
    public function index(): View
    {
        $users       = User::with(['role', 'department'])->get();
        $roles       = Role::all();
        $departments = Department::all();

        return view('users.index', compact('users', 'roles', 'departments'));
    }

    // Show the form to create a new user
    public function create(): View
    {
        $roles       = Role::all();
        $departments = Department::all();

        return view('users.create', compact('roles', 'departments'));
    }

    // Store a newly created user in the database
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name'     => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'         => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'      => ['required', 'string', 'min:6'],
            'phone'         => ['required', 'string', 'max:50'],
            'birth_date'    => ['required', 'date'],
            'role_id'       => ['required', 'integer', 'exists:roles,id'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'status'        => ['required', 'in:active,inactive'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.dashboard')
            ->with('success', 'User created successfully.');
    }

    // View single user details profile view
    public function show(User $user): View
    {
        $user->load(['role', 'department', 'courses', 'sections', 'lectures']);

        return view('users.show', compact('user'));
    }

    // Show the form for editing an existing user
    public function edit(User $user): View
    {
        $roles       = Role::all();
        $departments = Department::all();

        return view('users.edit', compact('user', 'roles', 'departments'));
    }

    // Update the specified user in the database
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'full_name'     => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email'         => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password'      => ['nullable', 'string', 'min:6'],
            'phone'         => ['required', 'string', 'max:50'],
            'birth_date'    => ['required', 'date'],
            'role_id'       => ['required', 'integer', 'exists:roles,id'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'status'        => ['required', 'in:active,inactive'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Keep existing password if left blank
        }

        $user->update($validated);

        return redirect()->route('users.dashboard')
            ->with('success', 'User updated successfully.');
    }

    // Remove the specified user from the database
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.dashboard')
            ->with('success', 'User deleted successfully.');
    }

    // View roles & permissions list
    public function roles()
    {
        return Role::with('permissions')->get();
    }
}