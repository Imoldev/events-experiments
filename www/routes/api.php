<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {

    $user = User::create(['name' => 'test', 'email' => 'test@test.com', 'password' => 'test' ]);

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

    }

    $user->createToken('test');
    $token = $request->user()->createToken('auth');

    return ['token' => $token->plainTextToken];
});
