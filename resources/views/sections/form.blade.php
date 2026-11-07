<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="row g-3">
        <!-- Section Name -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="section_name">Section name</label>
            <input id="section_name" name="section_name" value="{{ old('section_name', $section->section_name ?? '') }}"
                class="form-control ec-input" required>
        </div>

        <!-- Course Dropdown -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="course_id">Course</label>
            <select id="course_id" name="course_id" class="form-select ec-select" required>
                <option value="">Select a course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" @selected(old('course_id', $section->course_id ?? '') == $course->id)>
                        {{ $course->course_name }} ({{ $course->course_code }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Instructor Dropdown -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="instructor_id">Instructor</label>
            <select id="instructor_id" name="instructor_id" class="form-select ec-select" required>
                <option value="">Select an instructor</option>
                @foreach ($instructors as $instructor)
                    <option value="{{ $instructor->id }}" @selected(old('instructor_id', $section->instructor_id ?? '') == $instructor->id)>
                        {{ $instructor->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-semibold" for="capacity">Capacity</label>
            <input id="capacity" name="capacity" type="number" min="1"
                value="{{ old('capacity', $section->capacity ?? '') }}"
                class="form-control ec-input" required>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4">
        <button class="btn btn-ec-primary">{{ $submitLabel }}</button>
        <a href="{{ route('students.sections.index') }}" class="btn btn-ec-light">Cancel</a>
    </div>
</form>