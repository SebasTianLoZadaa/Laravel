<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('password can be uploaded', function (){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/user/password', [
        'current_password' => 'password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    expect(Hash :: check('new-password', 
    $user->fresh()->password))->toBeTrue();
    
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create();

    $response = $this
    ->actingAs($user)
    ->from('profile')
    ->put('password', [
        'current_password' => 'wrong-password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response
    ->assertSessionHasErrorsIn(
        'updatePassword', 'current_password'
    )
    ->assertRedirect('/profile');

});