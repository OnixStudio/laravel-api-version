<?php

use Illuminate\Support\Facades\Route;
use Onixstudio\ApiVersion\Http\Controllers\VersionController;

Route::middleware('auth:sanctum')->get('/version', VersionController::class);
