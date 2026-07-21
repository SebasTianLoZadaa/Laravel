<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it ('Allows users to login and access a protected route', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $loginresponse = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $loginresponse->assertStatus(200)
    ->assertJsonStructure(['token', 'token_type', 'expires_in', 'user'])
    ->assertJsonPath('user.email', $user->email);

    $token = $loginresponse->json('token');

    $this->withHeader('Authorization', 'Bearer '. $token)
    ->getJson('/api/me')
    ->assertStatus(200)
    ->assertJsonPath('email', $user->email);

});
