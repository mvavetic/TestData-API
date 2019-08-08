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

class CountryController extends Controller
{
    /**
     * Get all countries
     *
     * @param CountryListRequest $request
     * @param CountryService $countryService
     * @return ReturnTypeInterface
     * @throws
     */
    public function index(CountryListRequest $request, CountryService $countryService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        $countries = $countryService->findAll();

        if ($data['data_format'] === DataFormat::JSON) {

            if (empty($data['load_with'])) {
                $countriesResource = new CountryResource($countries);

                return new JsonResponse($countriesResource->collection($countries), HttpStatusCode::HTTP_OK);

            } else {
                $relations = explode(', ', $data['load_with']);

                $countriesWithRelations = $countryService->findAllWithRelations($relations);

                $countriesResource = new CountryResource($countriesWithRelations);

                return new JsonResponse($countriesResource->collection($countriesWithRelations), HttpStatusCode::HTTP_OK);
            }
        } elseif ($data['data_format'] === DataFormat::XML) {

            if (empty($data['load_with'])) {
                return $this->responseFactory->view('XML.country.list', compact('countries'))->header('Content-Type', 'text/xml');

            } else {
                $relations = explode(', ', $data['load_with']);

                $countries = $countryService->findAllWithRelations($relations);

                return $this->responseFactory->view('XML.country.list', compact('countries'))->header('Content-Type', 'text/xml');
            }
        }
    }
}
