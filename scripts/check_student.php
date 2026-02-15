<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$student = \App\Models\Student::where('student_number','143902')->first();
if ($student) {
    echo $student->student_number . ' - ' . $student->first_name . ' ' . $student->last_name . ' <' . $student->email . '>' . PHP_EOL;
} else {
    echo 'NOT_FOUND' . PHP_EOL;
}
