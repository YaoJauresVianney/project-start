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

test('request and change password change', function () {
    $user = app(AuthenticationContract::class)->register([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => 'password',
    ]);

    $response = $this->postJson(route('password.email'), ['email' => $user->email]);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['message']);

    dump($response->json(), $user->email);
    // validate new password
    $token = "842464s56d45d486ds5435sd435s4df";
    $response = $this->postJson(route('password.update'), [
        'token' => $token,
        'email' => $user->email,
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    dump($response->json());

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['message']);
});