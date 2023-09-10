<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * Test login with valid credentials.
     *
     * @return void
     */
    public function test_login_sucess(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/tokens/create', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
        ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'auth_token',
        ]);
    }

    /**
     * Test login with invalid credentials.
     *
     * @return void
     */
    public function test_login_failure_pw(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/tokens/create', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertStatus(401);

        $response->assertJsonStructure([
            'message',
        ]);

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'auth_token',
        ]);
    }

    /**
     * Test login with invalid credentials.
     *
     * @return void
     */
    public function test_login_failure_email(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/tokens/create', [
            'email' => 'invalid-email',
            'password' => 'password',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
        ]);

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'auth_token',
        ]);
    }

    /**
     * Test login with invalid credentials.
     *
     * @return void
     */
    public function test_login_failure_empty(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/tokens/create', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
        ]);

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'auth_token',
        ]);
    }

    /**
     * Test Logout.
     *
     * @return void
     */
    public function test_login_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/tokens/create', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
        ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'auth_token',
        ]);

        $token = $response->json()['access_token'];

        $response = $this->deleteJson('/api/tokens/delete', [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
        ]);

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'auth_token',
        ]);
    }
}
