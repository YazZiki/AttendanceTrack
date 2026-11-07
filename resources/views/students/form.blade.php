<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="row g-3">
        <!-- Full Name -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="full_name">Full Name</label>
            <input id="full_name" name="full_name" value="{{ old('full_name', $student->full_name ?? '') }}"
                class="form-control ec-input" required>
        </div>

        <!-- University ID -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="university_id">University ID</label>
            <input id="university_id" name="university_id"
                value="{{ old('university_id', $student->university_id ?? '') }}" class="form-control ec-input"
                required>
        </div>

        <!-- National ID -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="national_id">National ID</label>
            <input id="national_id" name="national_id" value="{{ old('national_id', $student->national_id ?? '') }}"
                class="form-control ec-input" required>
        </div>

        <!-- Birth Date -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="birth_date">Birth Date</label>
            <input id="birth_date" name="birth_date" type="date"
                value="{{ old('birth_date', $student->birth_date ?? '') }}" class="form-control ec-input" required>
        </div>

        <!-- Phone -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="phone">Phone Number</label>
            <input id="phone" name="phone" value="{{ old('phone', $student->phone ?? '') }}"
                class="form-control ec-input" required>
        </div>

        <!-- Email (Optional) -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="email">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email', $student->email ?? '') }}"
                class="form-control ec-input">
        </div>

        <!-- Department Dropdown (Replaces 'major') -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="department_id">Department / Faculty</label>
            <select id="department_id" name="department_id" class="form-select ec-select" required>
                <option value="">Select Department</option>
                @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}" @selected(old('department_id', $student->department_id ?? '') == $dept->id)>
                        {{ $dept->department_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Academic Year (Replaces 'year') -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="academic_year">Academic Year</label>
            <select id="academic_year" name="academic_year" class="form-select ec-select" required>
                <option value="">Select Year</option>
                <option value="1" @selected(old('academic_year', $student->academic_year ?? '') == '1')>First Year
                </option>
                <option value="2" @selected(old('academic_year', $student->academic_year ?? '') == '2')>Second Year
                </option>
                <option value="3" @selected(old('academic_year', $student->academic_year ?? '') == '3')>Third Year
                </option>
                <option value="4" @selected(old('academic_year', $student->academic_year ?? '') == '4')>Fourth Year
                </option>
            </select>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4">
        <button class="btn btn-ec-primary">{{ $submitLabel }}</button>
        <a href="{{ route('students.dashboard') }}" class="btn btn-ec-light">Cancel</a>
    </div>
</form>