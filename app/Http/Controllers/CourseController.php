<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Display all courses
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    // Show course details
    public function show($id)
    {
        $course = Course::with('students')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    // Show create form
    public function create()
    {
        return view('courses.create');
    }

    // Store new course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|unique:courses',
            'course_name' => 'required',
            'capacity' => 'required|integer|min:1'
        ]);

        $course = Course::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['course' => $course], 201);
        }

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }
}