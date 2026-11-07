<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label fw-semibold" for="section_name">Section name</label><input id="section_name" name="section_name" value="{{ old('section_name', $section->section_name ?? '') }}" class="form-control ec-input" required></div>
        <div class="col-md-6"><label class="form-label fw-semibold" for="course_id">Course</label><select id="course_id" name="course_id" class="form-select ec-select" required><option value="">Select a course</option>@foreach ($courses as $course)<option value="{{ $course->id }}" @selected(old('course_id', $section->course_id ?? '') == $course->id)>{{ $course->course_name }} ({{ $course->course_code }})</option>@endforeach</select></div>
    </div>
    <div class="d-flex gap-2 mt-4"><button class="btn btn-ec-primary">{{ $submitLabel }}</button><a href="{{ route('sections.index') }}" class="btn btn-ec-light">Cancel</a></div>
</form>
