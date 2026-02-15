<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display all students
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    // Show individual student profile
    public function show($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        return view('student.show', compact('student'));
    }

    // Show create form
    public function create()
    {
        return view('student.create');
    }

    // Store new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_number' => 'required|unique:students',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students'
        ]);

        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }
}