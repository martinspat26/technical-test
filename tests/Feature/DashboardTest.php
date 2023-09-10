<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * Test index.
     *
     * @return void
     */
    public function test_index(): void
    {
        $user = $this->user;
        $token = $this->token;

        $response = $this->get('/api/dashboard', [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test index unauthenticated.
     *
     * @return void
     */
    public function test_index_unauthenticated(): void
    {
        $response = $this->get('/api/dashboard', [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(401); // Unauthorized
    }
}
