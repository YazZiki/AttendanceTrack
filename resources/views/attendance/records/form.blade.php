<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label fw-semibold" for="lecture_id">Lecture</label><select id="lecture_id" name="lecture_id" class="form-select ec-select" required><option value="">Select a lecture</option>@foreach ($lectures as $lecture)<option value="{{ $lecture->id }}" @selected((string) old('lecture_id', $record->lecture_id ?? request('lecture_id', '')) === (string) $lecture->id)>{{ $lecture->title }} - {{ $lecture->lecture_date?->format('Y-m-d') }}</option>@endforeach</select></div>
        <div class="col-md-6"><label class="form-label fw-semibold" for="student_id">Student</label><select id="student_id" name="student_id" class="form-select ec-select" required><option value="">Select a student</option>@foreach ($students as $student)<option value="{{ $student->id }}" @selected(old('student_id', $record->student_id ?? '') == $student->id)>{{ $student->full_name }} ({{ $student->university_id }})</option>@endforeach</select></div>
        <div class="col-md-6"><label class="form-label fw-semibold" for="status">Status</label><select id="status" name="status" class="form-select ec-select" required>@foreach (['present', 'absent', 'late', 'excused'] as $status)<option value="{{ $status }}" @selected(old('status', $record->status ?? '') === $status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
        <div class="col-12"><label class="form-label fw-semibold" for="notes">Notes</label><textarea id="notes" name="notes" class="form-control ec-input" rows="3">{{ old('notes', $record->notes ?? '') }}</textarea></div>
    </div>
    <div class="d-flex gap-2 mt-4"><button class="btn btn-ec-primary">{{ $submitLabel }}</button><a href="{{ route('attendance.records.index') }}" class="btn btn-ec-light">Cancel</a></div>
</form>
