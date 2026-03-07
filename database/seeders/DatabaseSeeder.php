<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users you can use to log in from the frontend (Mini-Academic-Portal)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );
        User::firstOrCreate(
            ['email' => 'will@gmail.com'],
            ['name' => 'Will User', 'password' => bcrypt('willchill')]
        );

        // Create sample students if the students table and columns exist
        if (Schema::hasTable('students') && Schema::hasColumn('students', 'student_number')) {
            $students = [
                ['student_number' => 'S1001', 'first_name' => 'Alice', 'last_name' => 'Anderson', 'email' => 'alice@example.com'],
                ['student_number' => 'S1002', 'first_name' => 'Bob', 'last_name' => 'Brown', 'email' => 'bob@example.com'],
                ['student_number' => 'S1003', 'first_name' => 'Carol', 'last_name' => 'Clark', 'email' => 'carol@example.com'],
            ];

            foreach ($students as $s) {
                \App\Models\Student::firstOrCreate(['student_number' => $s['student_number']], $s);
            }
        }

        // Create sample courses if the courses table and columns exist
        if (Schema::hasTable('courses') && Schema::hasColumn('courses', 'course_code')) {
            $courses = [
                ['course_code' => 'CS101', 'course_name' => 'Intro to Computer Science', 'capacity' => 2],
                ['course_code' => 'MATH201', 'course_name' => 'Calculus I', 'capacity' => 3],
                ['course_code' => 'ENG150', 'course_name' => 'English Literature', 'capacity' => 2],
            ];

            foreach ($courses as $c) {
                \App\Models\Course::firstOrCreate(['course_code' => $c['course_code']], $c);
            }
        }
    }
}
