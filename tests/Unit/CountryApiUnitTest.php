<?php

namespace Tests\Unit;

use App\Http\Client\WorldBankApiClient;
use App\Http\Controllers\CountriesController;
use App\Http\Requests\GetCountryInfoRequest;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class CountryApiUnitTest extends TestCase
{

    public function test_string_all_as_country_iso_query_parameter_returns_bad_request(): void
    {
        $request = new GetCountryInfoRequest(['country_iso' => 'ALL']);

        $worldBankClient = Mockery::mock(WorldBankApiClient::class);

        $controller = new CountriesController();

        $response = $controller->getInfo($request, $worldBankClient);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->status());
    }
}
