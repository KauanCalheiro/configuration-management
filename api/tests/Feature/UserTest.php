<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase {
    use RefreshDatabase;

    private const LOGIN_ENDPOINT = '/api/auth/login';
    private const LOGOUT_ENDPOINT = '/api/auth/logout';
    private const LOGGED_USER_ENDPOINT = '/api/auth/user';
    private const TASKS_ENDPOINT = '/api/task';

    private const PASSWORD = 'password123';

    public function test_valid_login() {
        $user = User::factory()->create([
            'password' => bcrypt(self::PASSWORD),
        ]);

        $response = $this->postJson(self::LOGIN_ENDPOINT, [
            'email' => $user->email,
            'password' => self::PASSWORD,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function test_invalid_login() {
        $user = User::factory()->create([
            'password' => bcrypt(self::PASSWORD),
        ]);

        $response = $this->postJson(self::LOGIN_ENDPOINT, [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJsonStructure([
                'success',
                'message',
                'errors',
                'trace',
            ])
            ->assertJsonFragment([
                'success' => false,
                'message' => __('Unauthorized'),
            ]);
    }

    public function test_get_logged_user() {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson(self::LOGGED_USER_ENDPOINT);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'payload' => [
                    'id',
                    'name',
                    'email',
                    'roles',
                    'permissions',
                ],
                'count',
            ])
            ->assertJsonFragment([
                'success' => true,
                'message' => __('Request successfully'),
            ]);
    }

    public function test_access_protected_routes_without_login() {
        $response = $this->getJson(self::TASKS_ENDPOINT);

        $response->assertStatus(401)
            ->assertJsonFragment([
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test_access_protected_routes_with_login() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson(self::TASKS_ENDPOINT);

        $response->assertStatus(200);
    }

    public function test_logout() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(self::LOGOUT_ENDPOINT);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'payload',
                'count',
            ])
            ->assertJsonFragment([
                'success' => true,
                'message' => __('Successfully logged out'),
            ]);
    }
}
