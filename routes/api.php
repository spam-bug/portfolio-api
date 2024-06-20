<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Message\MessageController;
use App\Http\Controllers\Message\MessageStatusController;
use App\Http\Controllers\Message\UnreadMessageCountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('messages')->group(function () {
        Route::controller(MessageController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/{message}', 'show');
            Route::post('/store', 'store');
            Route::delete('{message}', 'destroy');
        });

        Route::patch('/{message}/mark-as-seen', [MessageStatusController::class, 'update']);
        Route::get('/unread/count', UnreadMessageCountController::class);
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
