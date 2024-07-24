<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class AuthControllerTest extends TestCase
{
    private $apiBaseUrl;

    protected function setUp(): void
    {
        parent::setUp();
        $this->apiBaseUrl = env('API_BASE_URL', 'https://campaignwithus.com/public/api');
        Http::fake();
    }

    public function test_user_can_register()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
            'date_of_birth' => '1990-01-01',
            'ghana_card_id' => 'GHA-123456789-0',
            'region_id' => '1',
            'constituency_id' => '1',
        ];

        Http::fake([
            "{$this->apiBaseUrl}/register" => Http::response(['token' => 'fake-token'], 201)
        ]);

        $response = $this->postJson("{$this->apiBaseUrl}/register", $userData);

        $response->assertStatus(201)
            ->assertJsonStructure(['token']);
    }

    public function test_user_cannot_register_with_invalid_data()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password',
        ];

        Http::fake([
            "{$this->apiBaseUrl}/register" => Http::response(['message' => 'The given data was invalid.'], 422)
        ]);

        $response = $this->postJson("{$this->apiBaseUrl}/register", $userData);

        $response->assertStatus(422)
            ->assertJsonStructure(['message']);
    }

    public function test_user_can_login()
    {
        $credentials = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        Http::fake([
            "{$this->apiBaseUrl}/login" => Http::response(['token' => 'fake-token'], 200)
        ]);

        $response = $this->postJson("{$this->apiBaseUrl}/login", $credentials);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $credentials = [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ];

        Http::fake([
            "{$this->apiBaseUrl}/login" => Http::response(['message' => 'Invalid credentials'], 401)
        ]);

        $response = $this->postJson("{$this->apiBaseUrl}/login", $credentials);

        $response->assertStatus(401)
            ->assertJsonStructure(['message']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Http::assertSent(function ($request) {
            return in_array($request->url(), [
                "{$this->apiBaseUrl}/register",
                "{$this->apiBaseUrl}/login"
            ]);
        });
    }
}
