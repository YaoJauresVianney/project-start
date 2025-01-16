<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Services\Contracts\AuthenticationContract;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

test('Adding an user', function () {
    $response = $this->postJson(route('auth.register'), [
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => 'password']);

    //$response->assertStatus(200);
    $response->assertStatus(Response::HTTP_CREATED);
});

test('verify user email', function () {
    $password = fake()->password(minLength: 8);
    $user = app(AuthenticationContract::class)->register([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => $password,
    ]);

    $response = $this->postJson(
        route('auth.login'),
        ['email' => $user->email, 'password' => $password]
    );

    $response = $this->postJson(
        route('verification.send'),
        headers: ['Authorization' => "Bearer {$response->json('token')}"]
    );

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['message']);
});

test('new', function () {
    $p = fake()->password(minLength: 8);
    $response = $this->postJson(
    route('auth.register', [
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => $p
    ]));
    $response->assertStatus(Response::HTTP_CREATED);
});