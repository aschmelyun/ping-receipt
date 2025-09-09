<?php

use App\Http\Controllers\SendMessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app', [
        'timestamp' => now()->format('m/d/y h:i A'),
        'transaction' => str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT),
    ]);
});

Route::post('/send-message', SendMessageController::class)->name('send-message');