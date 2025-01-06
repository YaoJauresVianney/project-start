<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Contracts\AuthenticationContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticationController extends Controller
{
    public function __construct(private readonly AuthenticationContract $service)
    {
        
    }
    public function register_page() {
        return view('admin.auth.register');
    }
    public function login_page() {
        return view('admin.auth.login');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->service->register($request->validated());

        return response()->json([
            'message' => 'User registered successfully'
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request) {
        $data = $this->service->login($request->validated());
        return response()->json($data, Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $this->service->logout(auth()->user(), $request->bearerToken());
        return response()->json(['message' => 'User logged out successfully', Response::HTTP_OK]);
    }
}
