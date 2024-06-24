<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRetrievalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_filters_users_by_verification_status()
    {
        User::factory()->create(['name' => 'Alice', 'is_verified' => true]);
        User::factory()->create(['name' => 'Bob', 'is_verified' => true]);
        User::factory()->create(['name' => 'Charlie', 'is_verified' => false]);

        // Filter users by verified status true
        $response = $this->getJson('/api/users?is_verified=true');
        $response->assertStatus(200);
        $response->assertJsonCount(2); // Expecting 2 verified users

        // Filter users by verified status false
        $response = $this->getJson('/api/users?is_verified=false');
        $response->assertStatus(200);
        $response->assertJsonCount(1); // Expecting 1 unverified user
    }
}
