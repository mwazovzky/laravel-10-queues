<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testIndex(): void
    {
        $user = User::factory()->create();

        Transaction::factory()->count(3)->create();

        $response = $this->actingAs($user)
            ->json('GET', '/api/transactions');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'type',
                        'status',
                        'txid',
                        'vout',
                        'amount',
                        'currency_id',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }
}
