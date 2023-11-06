<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Services\UserService;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller {

    public function login(LoginRequest $request, UserService $service) {
        return $service->login($request);
    }

    public function logout(Request $request, UserService $service) {
        return $service->logout($request);
    }
}
