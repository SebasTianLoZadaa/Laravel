<?php

use App\Models\User;

test('confirm password screen can be rendered', function (){
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/confirm-password');
    $response->assertStatus(200);


});

test('users can confirm their password', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('users cannot confirm their password with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});