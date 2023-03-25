<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrenciesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testIndex(): void
    {
        $user = User::factory()->create();

        Currency::factory()->count(3)->create();

        $response = $this->actingAs($user)
            ->json('GET', '/api/currencies');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'iso',
                        'name',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }
}
