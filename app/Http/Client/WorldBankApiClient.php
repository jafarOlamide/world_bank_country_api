<?php

namespace App\Http\Client;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Log;

class WorldBankApiClient extends PendingRequest
{
    public function getCountryData($country_iso)
    {
        $endpoint = 'country/' . $country_iso;

        $response = $this->get($endpoint, ['format' => 'json']);

        return $response->json();
    }
}
