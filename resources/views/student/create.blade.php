@extends('layouts.app')

@section('content')
<a href="{{ route('students.index') }}" style="display: inline-flex; align-items: center; color: #3182ce; text-decoration: none; margin-bottom: 20px; font-size: 14px;">
    <span style="margin-right: 6px;">←</span> Back to Students
</a>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 style="margin: 0 0 16px 0; font-size: 18px;">Add New Student</h3>
                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="student_number" class="form-label">Student Number</label>
                        <input type="text" class="form-control @error('student_number') is-invalid @enderror" 
                               id="student_number" name="student_number" value="{{ old('student_number') }}" required>
                        @error('student_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                               id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                               id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn btn-primary" style="flex: 1;">Create Student</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
