<?php

namespace App\Services;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Repositories\CountryRepository;
use Illuminate\Http\JsonResponse;

class CountryService extends Controller
{
    /**
     * Get all countries
     *
     * @param array $data
     * @return mixed
     */
    public function findAll(array $data)
    {
        $countryRepository = new CountryRepository();

        $countries = $countryRepository->findAll();

        if ($data['data_format'] === DataFormat::JSON) {
            $countriesMapper = new CountryResource($countries);
            return new JsonResponse($countriesMapper->collection($countries), HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            $xmlResponse = $this->responseFactory->view('XML.country.list', compact('countries'))->header('Content-Type', 'text/xml');
            return $xmlResponse;
        }
    }
}