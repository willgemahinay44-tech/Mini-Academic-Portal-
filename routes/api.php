<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/token-test', function () {
    $user = User::query()->first();

    if (! $user) {
        $user = User::query()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
    }

    return $user->createToken('test')->plainTextToken;
});

Route::post('/login', [AuthController::class, 'login']);
