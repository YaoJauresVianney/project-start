<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\AuthenticationContract;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationContract
{
    public function register(array $data):User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
    public function login(array $credentials):array{ 
        $user = User::where('email', $credentials['email'])->firstOrFail();
        if(is_null($user) || !Hash::check($credentials['password'], $user->password)) {
            throw new \Exception('Invalid credentials');
        }
        $token = $user->createToken('auth::token')->plainTextToken();
        return compact('user', 'token'); 
    }
    public function logout(){}
    public function refresh(){}
    public function user(){}
    public function delete(){}
}

?>