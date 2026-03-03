@extends('layouts.app')

@section('content')
<h1>Add New Student</h1>

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label class="form-label">Student Number</label>
        <input type="text" name="student_number" class="form-control @error('student_number') is-invalid @enderror" value="{{ old('student_number') }}">
        @error('student_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
        @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
        @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create Student</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection