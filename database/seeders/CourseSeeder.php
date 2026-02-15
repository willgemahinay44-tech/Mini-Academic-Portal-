<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            ['course_code' => 'CS101', 'course_name' => 'Introduction to Computer Science', 'capacity' => 30],
            ['course_code' => 'CS102', 'course_name' => 'Programming Fundamentals', 'capacity' => 40],
            ['course_code' => 'CS202', 'course_name' => 'Data Structures and Algorithms', 'capacity' => 25],
            ['course_code' => 'WEB301', 'course_name' => 'Web Development', 'capacity' => 20],
            ['course_code' => 'DB401', 'course_name' => 'Database Management Systems', 'capacity' => 15],
            ['course_code' => 'MATH201', 'course_name' => 'Discrete Mathematics', 'capacity' => 35],
            ['course_code' => 'ENG150', 'course_name' => 'English Literature', 'capacity' => 25],
            ['course_code' => 'PHYS101', 'course_name' => 'Physics I', 'capacity' => 30],
            ['course_code' => 'CHEM101', 'course_name' => 'Chemistry I', 'capacity' => 30],
            ['course_code' => 'HIST200', 'course_name' => 'World History', 'capacity' => 40],
            ['course_code' => 'MATH101', 'course_name' => 'Calculus I', 'capacity' => 45],
            ['course_code' => 'AI410', 'course_name' => 'Introduction to Artificial Intelligence', 'capacity' => 20],
        ];

        foreach ($courses as $c) {
            \App\Models\Course::firstOrCreate(['course_code' => $c['course_code']], $c);
        }
    }
}
