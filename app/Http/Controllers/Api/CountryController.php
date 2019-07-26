<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryListRequest;
use App\Services\CountryService;

class CountryController extends Controller
{
    /**
     * Get all countries
     *
     * @param CountryListRequest $request
     * @param CountryService $countryService
     * @return mixed
     */
    public function index(CountryListRequest $request, CountryService $countryService)
    {
        $data = $request->validateData();

        return $countryService->findAll($data);
    }
}
