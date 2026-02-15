@extends('layouts.app')

@section('content')
<a href="{{ route('students.index') }}" style="display: inline-flex; align-items: center; color: #3182ce; text-decoration: none; margin-bottom: 20px; font-size: 14px;">
    <span style="margin-right: 6px;">←</span> Back to Students
</a>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card" style="border-left: 3px solid #3182ce;">
            <div class="card-body text-center">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 32px; margin: 0 auto 16px;">
                    {{ strtoupper(substr($student->first_name, 0, 1)) }}
                </div>
                <h3 style="margin: 0 0 4px 0; font-size: 20px;">{{ $student->first_name }} {{ $student->last_name }}</h3>
                <p style="margin: 0 0 12px 0; color: #718096; font-size: 13px;">{{ $student->student_number }}</p>
                <div style="border-top: 1px solid #f7fafc; padding-top: 12px;">
                    <p style="margin: 8px 0; color: #718096; font-size: 13px;">{{ $student->email }}</p>
                    <p style="margin: 8px 0 0 0; color: #3182ce; font-weight: 500; font-size: 14px;">{{ $student->courses->count() }} Courses Enrolled</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <h3 style="font-size: 18px; margin-bottom: 16px;">Enrolled Courses</h3>
        @if($student->courses->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 12px;">
                @foreach($student->courses as $course)
                <div class="card" style="border-left: 3px solid #48bb78;">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <h5 style="margin: 0 0 4px 0; font-size: 15px;">{{ $course->course_name }}</h5>
                                <p style="margin: 0; color: #718096; font-size: 13px;">{{ $course->course_code }}</p>
                                <p style="margin: 4px 0 0 0; color: #718096; font-size: 12px;">Enrolled: {{ $course->pivot->created_at->format('M d, Y') }}</p>
                            </div>
                            <form method="POST" action="{{ route('unenroll') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Unenroll from this course?')">Unenroll</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p style="color: #718096; font-size: 14px;">No courses enrolled yet.</p>
        @endif

        <h3 style="font-size: 18px; margin: 24px 0 16px 0;">Available Courses</h3>
        @php
            $available = \App\Models\Course::whereNotIn('id', $student->courses->pluck('id'))->get();
        @endphp
        
        @if($available->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 12px;">
                @foreach($available as $course)
                <div class="card" style="border-top: 3px solid #48bb78;">
                    <div class="card-body">
                        <h5 style="margin: 0 0 4px 0; font-size: 14px;">{{ $course->course_name }}</h5>
                        <p style="margin: 0; color: #718096; font-size: 12px;">{{ $course->course_code }}</p>
                        <p style="margin: 8px 0 0 0; color: #718096; font-size: 12px;">{{ $course->students->count() }}/{{ $course->capacity }} enrolled</p>
                        <form method="POST" action="{{ route('enroll') }}" style="margin-top: 10px;">
                            @csrf
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <button type="submit" class="btn btn-primary btn-sm" style="width: 100%;">Enroll</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p style="color: #718096; font-size: 14px;">All courses are already enrolled or not available.</p>
        @endif
    </div>
</div>
@endsection