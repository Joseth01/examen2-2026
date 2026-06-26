<?php

use App\Http\Controllers\RealtimeSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'throttle:openai'])
    ->post('/realtime/sessions', [RealtimeSessionController::class, 'store']);
