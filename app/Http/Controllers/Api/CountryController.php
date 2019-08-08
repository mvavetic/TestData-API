<?php

namespace App\Http\Controllers\Api;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryListRequest;
use App\Http\Resources\CountryResource;
use App\Interfaces\ReturnTypeInterface;
use App\Services\CountryService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CountryInfoRequest;

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

        $countries = $countryService->findAll();

        if ($data['data_format'] === DataFormat::JSON) {
            $countriesMapper = new CountryResource($countries);

            return new JsonResponse($countriesMapper->collection($countries), HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.country.list', compact('countries'))->header('Content-Type', 'text/xml');
        }
    }

    /**
     * Get a single country by id
     *
     * @param CountryInfoRequest $request
     * @param CountryService $countryService
     * @return ReturnTypeInterface
     */
    public function show(CountryInfoRequest $request, CountryService $countryService)
    {
        $data = $request->validateData();

        $country = $countryService->findById($data['id']);

        if ($data['data_format'] === DataFormat::JSON) {

            $countriesMapper = new CountryResource($country);

            $filter = $data['load_with'] === 'cities' ? $countriesMapper : $countriesMapper->makeHidden('capital');

            return new JsonResponse($filter, HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.country.info', compact('country'))->header('Content-Type', 'text/xml');
        }
    }
}
