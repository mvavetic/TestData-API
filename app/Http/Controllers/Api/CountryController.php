<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Repositories\CountryRepository;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    /**
     * Get all countries
     *
     * @param CountryRepository $countryRepository
     * @return JsonResponse
     */
    public function index(CountryRepository $countryRepository)
    {
        $countries = $countryRepository->findAll();

        $countriesMapper = new CountryResource($countries);

        return new JsonResponse($countriesMapper->collection($countries), HttpStatusCode::HTTP_OK);
    }
}
