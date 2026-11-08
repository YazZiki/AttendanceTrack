<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    
    <div class="row g-3">
        <!-- Exam Type -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="exam_type_id">Exam Type</label>
            <select id="exam_type_id" name="exam_type_id" class="form-select ec-select" required>
                <option value="">Select Exam Type</option>
                @foreach ($examTypes as $type)
                    <option value="{{ $type->id }}" @selected(old('exam_type_id', $exam->exam_type_id ?? '') == $type->id)>
                        {{ $type->type_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Course -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="course_id">Course</label>
            <select id="course_id" name="course_id" class="form-select ec-select" required>
                <option value="">Select Course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" @selected(old('course_id', $exam->course_id ?? '') == $course->id)>
                        {{ $course->course_name }} ({{ $course->course_code }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Section -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="section_id">Section</label>
            <select id="section_id" name="section_id" class="form-select ec-select" required>
                <option value="">Select Section</option>
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}" @selected(old('section_id', $exam->section_id ?? '') == $section->id)>
                        Section #{{ $section->id }} - {{ $section->section_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Room -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="room">Room / Hall</label>
            <input id="room" name="room" value="{{ old('room', $exam->room ?? '') }}" class="form-control ec-input" placeholder="e.g. Hall A3" required>
        </div>

        <!-- Exam Date -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="exam_date">Exam Date</label>
            <input id="exam_date" type="date" name="exam_date" value="{{ old('exam_date', $exam->exam_date ?? '') }}" class="form-control ec-input" required>
        </div>

        <!-- Exam Time -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="exam_time">Exam Time</label>
            <input id="exam_time" type="time" name="exam_time" value="{{ old('exam_time', $exam->exam_time ?? '') }}" class="form-control ec-input" required>
        </div>

        <!-- Duration (Minutes) -->
        <div class="col-md-4">
            <label class="form-label fw-semibold" for="duration">Duration (Minutes)</label>
            <input id="duration" type="number" name="duration" value="{{ old('duration', $exam->duration ?? 60) }}" class="form-control ec-input" required>
        </div>

        <!-- Max Grade -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="max_grade">Maximum Grade</label>
            <input id="max_grade" type="number" step="0.5" name="max_grade" value="{{ old('max_grade', $exam->max_grade ?? 100) }}" class="form-control ec-input" required>
        </div>

        <!-- Min Passing Grade -->
        <div class="col-md-6">
            <label class="form-label fw-semibold" for="min_grade">Minimum Passing Grade</label>
            <input id="min_grade" type="number" step="0.5" name="min_grade" value="{{ old('min_grade', $exam->min_grade ?? 50) }}" class="form-control ec-input" required>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4">
        <button class="btn btn-ec-primary">{{ $submitLabel }}</button>
        <a href="{{ route('exams.dashboard') }}" class="btn btn-ec-light">Cancel</a>
    </div>
</form>