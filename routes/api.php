<?php

use Illuminate\Support\Facades\Route;
use TonVendor\ApiVersion\Http\Controllers\VersionController;

Route::middleware('auth:sanctum')->get('/version', VersionController::class);
