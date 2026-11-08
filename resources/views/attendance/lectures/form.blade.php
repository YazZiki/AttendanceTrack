<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="row g-3">
        <div class="col-12"><label class="form-label fw-semibold" for="title">Lecture title</label><input id="title" name="title" value="{{ old('title', $lecture->title ?? '') }}" class="form-control ec-input" required></div>
        <div class="col-md-4"><label class="form-label fw-semibold" for="lecture_date">Date</label><input id="lecture_date" name="lecture_date" type="date" value="{{ old('lecture_date', isset($lecture) && $lecture->lecture_date ? $lecture->lecture_date->format('Y-m-d') : '') }}" class="form-control ec-input" required></div>
        <div class="col-md-4"><label class="form-label fw-semibold" for="lecture_time">Time</label><input id="lecture_time" name="lecture_time" type="time" value="{{ old('lecture_time', $lecture->lecture_time ?? '') }}" class="form-control ec-input" required></div>
        <div class="col-md-4"><label class="form-label fw-semibold" for="duration">Duration (minutes)</label><input id="duration" name="duration" type="number" min="1" value="{{ old('duration', $lecture->duration ?? '') }}" class="form-control ec-input" required></div>
        <div class="col-md-4"><label class="form-label fw-semibold" for="course_id">Course</label><select id="course_id" name="course_id" class="form-select ec-select" required><option value="">Select a course</option>@foreach ($courses as $course)<option value="{{ $course->id }}" @selected(old('course_id', $lecture->course_id ?? '') == $course->id)>{{ $course->course_name }} ({{ $course->course_code }})</option>@endforeach</select></div>
        <div class="col-md-4"><label class="form-label fw-semibold" for="section_id">Section</label><select id="section_id" name="section_id" class="form-select ec-select" required><option value="">Select a section</option>@foreach ($sections as $section)<option value="{{ $section->id }}" @selected(old('section_id', $lecture->section_id ?? '') == $section->id)>{{ $section->section_name }} - {{ $section->course?->course_name }}</option>@endforeach</select></div>
        <div class="col-md-4"><label class="form-label fw-semibold" for="instructor_id">Instructor</label><select id="instructor_id" name="instructor_id" class="form-select ec-select" required><option value="">Select an instructor</option>@foreach ($instructors as $instructor)<option value="{{ $instructor->id }}" @selected(old('instructor_id', $lecture->instructor_id ?? '') == $instructor->id)>{{ $instructor->full_name }}</option>@endforeach</select></div>
    </div>
    <div class="d-flex gap-2 mt-4"><button class="btn btn-ec-primary">{{ $submitLabel }}</button><a href="{{ route('attendance.dashboard') }}" class="btn btn-ec-light">Cancel</a></div>
</form>
