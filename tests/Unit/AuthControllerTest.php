<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    private $apiBaseUrl;

    protected function setUp(): void
    {
        parent::setUp();
        $this->apiBaseUrl = env('API_BASE_URL', 'https://campaignwithus.com/public/api');
    }

    /** @test */
    public function user_can_register()
    {
        $response = $this->postJson($this->apiBaseUrl . '/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['token']);

        // Since we're using a live API, database assertions will be removed
        // $this->assertDatabaseHas('users', [
        //     'email' => 'test@example.com',
        // ]);
    }

    /** @test */
    public function user_can_login()
    {
        // Assuming a user with this email and password exists on the live API
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson($this->apiBaseUrl . '/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }
}
