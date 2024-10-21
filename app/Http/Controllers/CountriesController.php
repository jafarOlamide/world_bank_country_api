<?php

namespace App\Http\Controllers;

use App\Http\Client\WorldBankApiClient;
use App\Http\Requests\GetCountryInfoRequest;
use App\Services\CountryApiService;
use Illuminate\Http\Response;

class CountriesController extends Controller
{
    public function getInfo(GetCountryInfoRequest $request, WorldBankApiClient $worldBankClient)
    {

        $countryIso = strtoupper($request->country_iso);

        //Parameter "ALL" returns all countries info and can break implementation.
        if ($countryIso == "ALL") {
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Invalid Country ISO'], Response::HTTP_BAD_REQUEST);
        }

        $countryInfo = CountryApiService::getCountriesInfo($countryIso, $worldBankClient);

        if (!$countryInfo) {
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Invalid Country ISO'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['status' => Response::HTTP_OK, 'data' => $countryInfo], Response::HTTP_OK);
    }
}
