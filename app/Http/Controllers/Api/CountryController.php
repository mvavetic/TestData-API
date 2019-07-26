<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryListRequest;
use App\Interfaces\ReturnTypeInterface;
use App\Services\CountryService;

class CountryController extends Controller
{
    /**
     * Get all countries
     *
     * @param CountryListRequest $request
     * @param CountryService $countryService
     * @return ReturnTypeInterface
     */
    public function index(CountryListRequest $request, CountryService $countryService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        return $countryService->findAll($data);
    }
}
