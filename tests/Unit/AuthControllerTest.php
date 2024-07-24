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
        dump("API Base URL: " . $this->apiBaseUrl); // Debug line
    }

    public function test_api_is_accessible()
    {
        $response = Http::get("{$this->apiBaseUrl}");
        dump($response->status(), $response->body()); // Debug line
        $this->assertEquals(200, $response->status());
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

        $response = Http::post("{$this->apiBaseUrl}/register", $userData);
        dump($response->status(), $response->body(), $response->headers()); // Debug line
        $this->assertEquals(201, $response->status());
        $this->assertArrayHasKey('token', $response->json());
    }

    public function test_user_can_login()
    {
        $credentials = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = Http::post("{$this->apiBaseUrl}/login", $credentials);
        dump($response->status(), $response->body(), $response->headers()); // Debug line
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('token', $response->json());
    }

    // Add more test methods as needed
}
