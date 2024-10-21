<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_protected_routes_cannot_be_accessed_by_unauthenticated_users_()
    {
        $response = $this->getJson(route('country.info'));

        $response->assertStatus(401);
    }

    public function test_only_authenticated_users_can_access_protected_routes()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->json('GET', route('country.info'), ['country_iso' => 'GBR']);

        $response->assertStatus(200);
    }
}
