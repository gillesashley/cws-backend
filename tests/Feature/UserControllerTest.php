<?php


namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->baseUrl = 'http://nginx:80';
    }


    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_user_with_role_user()
    {
        $response = $this->post('/admin/users', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'role' => 'user',
            'region_id' => 1,
            'constituency_id' => 1,
            'phone' => '1234567890',
            'date_of_birth' => '2000-01-01',
            'ghana_card_id' => 'GHA-123456',
            'ghana_card_image_path' => null,
            'area' => 'Test Area',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'role' => 'user',
        ]);
    }

    public function test_create_user_with_role_constituency_admin()
    {
        $response = $this->post('/admin/users', [
            'name' => 'Test Constituency Admin',
            'email' => 'testconstituencyadmin@example.com',
            'role' => 'constituency_admin',
            'region_id' => 1,
            'constituency_id' => 1,
            'phone' => '1234567890',
            'date_of_birth' => '2000-01-01',
            'ghana_card_id' => 'GHA-123457',
            'ghana_card_image_path' => null,
            'area' => 'Test Area',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => 'testconstituencyadmin@example.com',
            'role' => 'constituency_admin',
        ]);
    }

    public function test_create_user_with_role_regional_admin()
    {
        $response = $this->post('/admin/users', [
            'name' => 'Test Regional Admin',
            'email' => 'testregionaladmin@example.com',
            'role' => 'regional_admin',
            'region_id' => 1,
            'constituency_id' => 1,
            'phone' => '1234567890',
            'date_of_birth' => '2000-01-01',
            'ghana_card_id' => 'GHA-123458',
            'ghana_card_image_path' => null,
            'area' => 'Test Area',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => 'testregionaladmin@example.com',
            'role' => 'regional_admin',
        ]);
    }

    public function test_create_user_with_role_national_admin()
    {
        $response = $this->post('/admin/users', [
            'name' => 'Test National Admin',
            'email' => 'testnationaladmin@example.com',
            'role' => 'national_admin',
            'region_id' => 1,
            'constituency_id' => 1,
            'phone' => '1234567890',
            'date_of_birth' => '2000-01-01',
            'ghana_card_id' => 'GHA-123459',
            'ghana_card_image_path' => null,
            'area' => 'Test Area',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => 'testnationaladmin@example.com',
            'role' => 'national_admin',
        ]);
    }

    public function test_create_user_with_role_application_admin()
    {
        $response = $this->post('/admin/users', [
            'name' => 'Test Application Admin',
            'email' => 'testapplicationadmin@example.com',
            'role' => 'application_admin',
            'region_id' => 1,
            'constituency_id' => 1,
            'phone' => '1234567890',
            'date_of_birth' => '2000-01-01',
            'ghana_card_id' => 'GHA-123460',
            'ghana_card_image_path' => null,
            'area' => 'Test Area',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => 'testapplicationadmin@example.com',
            'role' => 'application_admin',
        ]);
    }

    public function test_update_user()
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'oldemail@example.com',
            'role' => 'user',
            'region_id' => 1,
            'constituency_id' => 1,
        ]);

        $response = $this->put("/admin/users/{$user->id}", [
            'name' => 'New Name',
            'email' => 'newemail@example.com',
            'role' => 'user',
            'region_id' => 1,
            'constituency_id' => 1,
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'newemail@example.com',
        ]);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->delete("/admin/users/{$user->id}");

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
