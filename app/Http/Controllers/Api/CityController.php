<?php

namespace App\Http\Controllers\Api;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Exceptions\SystemException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityInfoRequest;
use App\Interfaces\ReturnTypeInterface;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CitiesListRequest;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    /**
     * Get all cities
     *
     * @param CitiesListRequest $request
     * @param CityService $cityService
     * @return ReturnTypeInterface
     * @throws SystemException|NotFoundException
     */
    public function index(CitiesListRequest $request, CityService $cityService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        $cities = $cityService->findAll();

        if ($data['data_format'] === DataFormat::JSON) {
            $citiesMapper = new CityResource($cities);
            return new JsonResponse($citiesMapper->collection($cities), HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.city.list', compact('cities'))->header('Content-Type', 'text/xml');
        }
    }

    /**
     * Get a single city
     *
     * @param CityInfoRequest $request
     * @param CityService $cityService
     * @return ReturnTypeInterface
     * @throws SystemException
     */
    public function show(CityInfoRequest $request, CityService $cityService)
    {
        $data = $request->validateData();

        $city = $cityService->findById($data['id']);

        if ($data['dataFormat'] === DataFormat::JSON) {
            $cityMapper = new CityResource($city);
            return new JsonResponse($cityMapper, HttpStatusCode::HTTP_OK);
        } elseif ($data['dataFormat'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.city.info', compact('city'))->header('Content-Type', 'text/xml');
        }
    }
}
