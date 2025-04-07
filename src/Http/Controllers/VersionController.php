<?php

namespace Onixstudio\ApiVersion\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Application;

class VersionController
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'laravel_version' => Application::VERSION,
        ]);
    }
}
