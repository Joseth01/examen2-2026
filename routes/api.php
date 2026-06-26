<?php

use App\Http\Controllers\RealtimeSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::middleware(['auth:sanctum', 'throttle:openai'])
    ->post('/realtime/sessions', [RealtimeSessionController::class, 'store']);

    Route::post('/materiales', [MaterialController::class, 'store']);
