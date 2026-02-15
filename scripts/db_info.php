<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
echo 'DB_DATABASE=' . env('DB_DATABASE') . PHP_EOL;
echo 'DB_CONNECTION=' . env('DB_CONNECTION') . PHP_EOL;
echo 'DB_HOST=' . env('DB_HOST') . PHP_EOL;
$pdo = DB::connection()->getPdo();
$database = DB::connection()->getDatabaseName();
echo 'Connected DB: ' . $database . PHP_EOL;
