<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label fw-semibold" for="full_name">Full name</label><input id="full_name" name="full_name" value="{{ old('full_name', $student->full_name ?? '') }}" class="form-control ec-input" required></div>
        <div class="col-md-6"><label class="form-label fw-semibold" for="university_id">University ID</label><input id="university_id" name="university_id" value="{{ old('university_id', $student->university_id ?? '') }}" class="form-control ec-input" required></div>
        <div class="col-md-6"><label class="form-label fw-semibold" for="national_id">National ID</label><input id="national_id" name="national_id" value="{{ old('national_id', $student->national_id ?? '') }}" class="form-control ec-input" required></div>
        <div class="col-md-6"><label class="form-label fw-semibold" for="major">Major</label><input id="major" name="major" value="{{ old('major', $student->major ?? '') }}" class="form-control ec-input" required></div>
        <div class="col-md-6"><label class="form-label fw-semibold" for="year">Year</label><input id="year" name="year" value="{{ old('year', $student->year ?? '') }}" class="form-control ec-input" required></div>
    </div>
    <div class="d-flex gap-2 mt-4"><button class="btn btn-ec-primary">{{ $submitLabel }}</button><a href="{{ route('students.index') }}" class="btn btn-ec-light">Cancel</a></div>
</form>
