<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendVerificationEmail;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_user_and_dispatches_verification_email()
    {
        Queue::fake();

        $response = $this->postJson('/api/user', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        if ($response->status() !== 201) {
            dd($response->json());
        }

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        Queue::assertPushed(SendVerificationEmail::class, function ($job) {
            return $job->getEmail() === 'test@example.com';
        });
    }

    /** @test */
    public function it_requires_a_unique_email()
    {
        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->postJson('/api/user', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }
}
