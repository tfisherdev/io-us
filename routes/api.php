<?php

use App\Http\Controllers\Api\UserBalanceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/groups/{group}/balance', [UserBalanceController::class, 'show']);
