<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TemporaryStudentSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Student::firstOrCreate([
            'student_number' => '143902'
        ], [
            'first_name' => 'willge',
            'last_name' => 'Mahinay1',
            'email' => 'willgemahinay4@gmail.com'
        ]);
    }
}
