@extends('layouts.app')

@section('content')
<a href="{{ route('courses.index') }}" style="display: inline-flex; align-items: center; color: #3182ce; text-decoration: none; margin-bottom: 20px; font-size: 14px;">
    <span style="margin-right: 6px;">←</span> Back to Courses
</a>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 style="margin: 0 0 16px 0; font-size: 18px;">Add New Course</h3>
                <form method="POST" action="{{ route('courses.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="course_code" class="form-label">Course Code</label>
                        <input type="text" class="form-control @error('course_code') is-invalid @enderror" 
                               id="course_code" name="course_code" value="{{ old('course_code') }}" required>
                        @error('course_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control @error('course_name') is-invalid @enderror" 
                               id="course_name" name="course_name" value="{{ old('course_name') }}" required>
                        @error('course_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                               id="capacity" name="capacity" value="{{ old('capacity') }}" min="1" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn btn-primary" style="flex: 1;">Create Course</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection