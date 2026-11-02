<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'is_admin' => true,
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home', absolute: false));

    $user = \App\Models\User::where('email', 'test@example.com')->first();
    expect($user->first_name)->toBe('Test')
        ->and($user->last_name)->toBe('User')
        ->and((bool) $user->is_admin)->toBeFalse();
});
