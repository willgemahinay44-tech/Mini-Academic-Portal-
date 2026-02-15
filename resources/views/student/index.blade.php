@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 style="margin: 0; font-size: 28px;">Students</h1>
        <p style="margin: 6px 0 0 0; color: #718096; font-size: 14px;">View all registered students</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary">+ Add Student</a>
</div>

<div class="row">
    @foreach($students as $student)
    <div class="col-md-4 mb-4">
        <div class="card h-100" style="border-left: 3px solid #3182ce;">
            <div class="card-body">
                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 18px;">
                        {{ strtoupper(substr($student->first_name, 0, 1)) }}
                    </div>
                    <div style="margin-left: 12px; flex: 1;">
                        <h5 style="margin: 0; font-size: 16px;">{{ $student->first_name }} {{ $student->last_name }}</h5>
                        <p style="margin: 2px 0 0 0; color: #718096; font-size: 13px;">{{ $student->student_number }}</p>
                    </div>
                </div>
                <div style="border-top: 1px solid #f7fafc; padding-top: 12px;">
                    <p style="margin: 0; color: #718096; font-size: 13px;">{{ $student->email }}</p>
                    <p style="margin: 8px 0 0 0; color: #3182ce; font-weight: 500; font-size: 13px;">{{ $student->courses->count() }} Courses</p>
                </div>
                <a href="{{ route('students.show', $student->id) }}" class="btn btn-primary btn-sm" style="margin-top: 12px; width: 100%;">View Details</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection