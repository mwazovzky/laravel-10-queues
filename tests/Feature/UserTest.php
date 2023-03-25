<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $now = Carbon::create(2023, 03, 25, 18, 0, 0);
        Carbon::setTestNow($now);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('GET', '/api/user');

        $response->assertStatus(200)
            ->assertJson([
                "name" => $user->name,
                "email" => $user->email,
                "email_verified_at" => $now->toJSON(),
                "updated_at" => $now->toJSON(),
                "created_at" => $now->toJSON(),
                "id" => $user->id,
            ]);
    }
}
