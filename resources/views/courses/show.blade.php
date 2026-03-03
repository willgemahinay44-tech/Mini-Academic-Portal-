@extends('layouts.app')

@section('content')
<a href="{{ route('courses.index') }}" style="display: inline-flex; align-items: center; color: #3182ce; text-decoration: none; margin-bottom: 20px; font-size: 14px;">
    <span style="margin-right: 6px;">←</span> Back to Courses
</a>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card" style="border-top: 3px solid #48bb78;">
            <div class="card-body">
                <div style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 24px; margin-bottom: 16px;">
                    📚
                </div>
                <h3 style="margin: 0 0 4px 0; font-size: 18px; line-height: 1.3;">{{ $course->course_name }}</h3>
                <p style="margin: 0 0 12px 0; color: #718096; font-size: 13px;">{{ $course->course_code }}</p>
                <div style="border-top: 1px solid #f7fafc; padding-top: 12px;">
                    <div style="margin-bottom: 12px;">
                        <p style="margin: 0; color: #718096; font-size: 12px;">Enrollment Status</p>
                        <p style="margin: 4px 0 0 0; font-weight: 500; font-size: 14px;">{{ $course->students->count() }}/{{ $course->capacity }}</p>
                        <div style="height: 4px; background-color: #f7fafc; border-radius: 2px; margin-top: 6px; overflow: hidden;">
                            <div style="height: 100%; background-color: #48bb78; width: {{ ($course->students->count() / $course->capacity) * 100 }}%;"></div>
                        </div>
                    </div>
                    <p style="margin: 8px 0 0 0; color: #718096; font-size: 12px;">{{ $course->capacity - $course->students->count() }} seats remaining</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 style="margin: 0; font-size: 18px;">Enrolled Students</h3>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#enrollModal">+ Add Student</button>
        </div>

        @if($course->students->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 10px;">
                @foreach($course->students as $student)
                <div class="card" style="border-left: 3px solid #3182ce;">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div style="display: flex; align-items: center; flex: 1;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; margin-right: 12px;">
                                    {{ strtoupper(substr($student->first_name, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 style="margin: 0 0 2px 0; font-size: 14px;">{{ $student->first_name }} {{ $student->last_name }}</h5>
                                    <p style="margin: 0; color: #718096; font-size: 12px;">{{ $student->student_number }} • {{ $student->email }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('unenroll') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove student?')">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p style="color: #718096; font-size: 14px;">No students enrolled yet.</p>
        @endif
    </div>
</div>


<div class="modal fade" id="enrollModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border: 1px solid #e2e8f0;">
            <div class="modal-header" style="border-bottom: 1px solid #e2e8f0;">
                <h5 class="modal-title" style="font-size: 16px; font-weight: 500;">Add Student to Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('enroll') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Select Student</label>
                        <select name="student_id" id="student_id" class="form-select" required>
                            <option value="">-- Choose a student --</option>
                            @foreach(\App\Models\Student::all() as $student)
                                @if(!$course->students->contains($student->id))
                                    <option value="{{ $student->id }}">{{ $student->student_number }} - {{ $student->first_name }} {{ $student->last_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0; gap: 8px;">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Enroll</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection