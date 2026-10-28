<?php

use App\Http\Controllers\web\TypingTestController;
use Illuminate\Support\Facades\Route;

# TYPING SPEED TEST MODULE ROUTES
Route::controller(TypingTestController::class)->group(function () {
    Route::get('/', 'index')->name('typing-test');
});
