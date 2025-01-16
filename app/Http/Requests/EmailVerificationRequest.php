<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class EmailVerificationRequest extends \Illuminate\Foundation\Auth\EmailVerificationRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], string $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        Auth::login(User::findOr(
            request()->route('id'),
            fn () => abort(Response::HTTP_UNAUTHORIZED)
        ));
    }
}
