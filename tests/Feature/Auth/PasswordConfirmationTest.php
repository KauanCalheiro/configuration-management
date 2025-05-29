<?php

namespace Tests\Feature\Auth;

use App\Livewire\Auth\ConfirmPassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_confirmed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test(ConfirmPassword::class)
            ->set('password', 'password')
            ->call('confirmPassword');

        $response
            ->assertHasNoErrors()
            ->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test(ConfirmPassword::class)
            ->set('password', 'wrong-password')
            ->call('confirmPassword');

        $response->assertHasErrors(['password']);
    }
}
