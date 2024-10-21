<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CountryApiTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(
            User::factory()->create(),
        );
    }

    public function test_valid_country_iso_returns_country_info_in_json()
    {

        $response = $this->json('GET', route('country.info'), ['country_iso' => 'GBR']);

        $response->assertJsonStructure([
            'status',
            'data'
        ]);
    }

    public function test_invalid_country_iso_returns_error_message()
    {
        $response = $this->json('GET', route('country.info'), ['country_iso' => 'INV']);

        $response->assertJsonStructure([
            'status',
            'message'
        ]);
    }
}
