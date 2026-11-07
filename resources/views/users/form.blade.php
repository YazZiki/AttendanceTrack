<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST') 
        @method($method) 
    @endif

    <div class="row g-3">
        <!-- Full Name -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name ?? '') }}" class="form-control ec-input" required>
        </div>

        <!-- Username -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" class="form-control ec-input" required>
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control ec-input" required>
        </div>

        <!-- Phone -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control ec-input" required>
        </div>

        <!-- Birth Date -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="birth_date">Birth Date</label>
            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', isset($user->birth_date) ? $user->birth_date->format('Y-m-d') : '') }}" class="form-control ec-input" required>
        </div>

        <!-- Password -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="password">Password {{ isset($user) ? '(Leave blank to keep current)' : '' }}</label>
            <input type="password" id="password" name="password" class="form-control ec-input" {{ isset($user) ? '' : 'required' }}>
        </div>

        <!-- Role Dropdown -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="role_id">Role</label>
            <select id="role_id" name="role_id" class="form-select ec-select" required>
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ ucfirst($role->role_name) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Department Dropdown -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="department_id">Department</label>
            <select id="department_id" name="department_id" class="form-select ec-select" required>
                <option value="">Select Department</option>
                @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}" @selected(old('department_id', $user->department_id ?? '') == $dept->id)>
                        {{ $dept->department_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Dropdown -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="status">Account Status</label>
            <select id="status" name="status" class="form-select ec-select" required>
                <option value="active" @selected(old('status', $user->status ?? '') == 'active')>Active</option>
                <option value="inactive" @selected(old('status', $user->status ?? '') == 'inactive')>Inactive</option>
            </select>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-ec-primary">{{ $submitLabel }}</button>
        <a href="{{ route('users.dashboard') }}" class="btn btn-ec-light">Cancel</a>
    </div>
</form>