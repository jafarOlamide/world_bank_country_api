<?php

namespace App\Services;

use App\Http\Client\WorldBankApiClient;
use Exception;

class CountryApiService
{
    public static function getCountriesInfo(string $countryIso, $client)
    {
        $apiResponse = $client->getCountryData($countryIso);

        if (count($apiResponse) === 1) {
            return static::processUnknownIso($apiResponse);
        }

        $successMessage = $apiResponse[1][0];

        $countryInfo = [
            'country_name'  => $successMessage['name'],
            'region'        => $successMessage['region']['value'],
            'capital_city'  => $successMessage['capitalCity'],
            'longitude'     => $successMessage['longitude'],
            'latitude'      => $successMessage['latitude'],
        ];

        return $countryInfo;
    }

    private static function processUnknownIso($response)
    {
        $errorMessage = $response[0]['message'][0];

        if ($errorMessage["id"] === "120") {
            return null;
        }

        throw new Exception('Cannot process request', 400);
    }
}
