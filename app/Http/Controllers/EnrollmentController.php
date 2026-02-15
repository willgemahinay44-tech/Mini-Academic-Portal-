<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'course_id' => 'required|integer|exists:courses,id',
        ]);

        $student = Student::findOrFail($data['student_id']);
        $course = Course::findOrFail($data['course_id']);

        // Check if already enrolled
        if ($student->courses()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'Student already enrolled in this course.');
        }

        // Check course capacity
        if ($course->students()->count() >= $course->capacity) {
            return redirect()->back()->with('error', 'Course is already full.');
        }

        $student->courses()->attach($course->id);
        return redirect()->back()->with('success', 'Enrollment successful.');
    }

    public function unenroll(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'course_id' => 'required|integer|exists:courses,id',
        ]);

        $student = Student::findOrFail($data['student_id']);
        $course = Course::findOrFail($data['course_id']);

        $student->courses()->detach($course->id);
        return redirect()->back()->with('success', 'Student unenrolled successfully.');
    }
}