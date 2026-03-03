@extends('layouts.app')

@section('content')
<h1>Enroll Student in Course</h1>

<form action="{{ route('enrollments.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label class="form-label">Select Student</label>
        <select name="student_id" class="form-control @error('student_id') is-invalid @enderror">
            <option value="">-- Choose Student --</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->student_number }} - {{ $student->first_name }} {{ $student->last_name }}
                </option>
            @endforeach
        </select>
        @error('student_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Select Course</label>
        <select name="course_id" class="form-control @error('course_id') is-invalid @enderror">
            <option value="">-- Choose Course --</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">
                    {{ $course->course_code }} - {{ $course->course_name }} 
                    ({{ $course->students->count() }}/{{ $course->capacity }})
                </option>
            @endforeach
        </select>
        @error('course_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Enroll</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection