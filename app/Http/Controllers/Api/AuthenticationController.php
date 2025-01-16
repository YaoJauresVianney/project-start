<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Notifications\Welcome;
use App\Services\Contracts\AuthenticationContract;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

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

        event(new Registered($user));

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

    public function refresh(Request $request)
    {
        $data = $this->service->refresh($request->bearerToken());
        return response()->json($data, Response::HTTP_OK);
    }

    public function me()
    {
        return response()->json(auth()->user(), Response::HTTP_OK);
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return response()->json(['message' => 'Email verified successfully'], Response::HTTP_OK);
    }

    public function resendVerificationEmail() :JsonResponse
    {
        auth()->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email verification link sent on your email id'], Response::HTTP_OK);
    }

    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return response()->json(['message' => __($status)], Response::HTTP_OK);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            fn($user) => $user->update(['password' => $request->password])
        );

        return response()->json(['message' => __($status)], Response::HTTP_OK);
    }
}
