<?php

namespace Tests\Feature;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_user_register(): void
    {
        $data = [
            'email' => 'test@test.com',
            'name' => 'test',
            'password' => 'Password123',
            'password_confirmation' => 'Password123'
        ];

        $creator = $this->app->make(CreateNewUser::class);

        $creator->create($data);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
            'name' => $data['name']
        ]);

    }

    /**
     * A basic feature test example.
     */
    public function test_can_login_via_external_oauth_provider(): void
    {

        $user = new \Laravel\Socialite\One\User();
        $user->id = 1;
        $user->nickname = 'test';
        $user->name = 'test';
        $user->email = 'test@test.com';

        $this->app->bind(User::class, fn () => $user);
        $response = $this->get('/oauth/google/callback');

        $response->assertOk();

    }
}
