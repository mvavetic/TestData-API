<?php

namespace App\Http\Controllers\Api;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Exceptions\ConflictException;
use App\Exceptions\NotFoundException;
use App\Exceptions\SystemException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityCreateRequest;
use App\Http\Requests\CityDeleteRequest;
use App\Http\Requests\CityInfoRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Interfaces\ReturnTypeInterface;
use App\Services\CityService;
use Illuminate\Auth\Access\AuthorizationException;
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
    public function show(CityInfoRequest $request, CityService $cityService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        $city = $cityService->findById($data['id']);

        if ($data['data_format'] === DataFormat::JSON) {
            $cityMapper = new CityResource($city);
            return new JsonResponse($cityMapper, HttpStatusCode::HTTP_OK);

        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.city.info', compact('city'))->header('Content-Type', 'text/xml');
        }
    }

    /**
     * Create a new city
     *
     * @param CityCreateRequest $request
     * @param CityService $cityService
     * @return JsonResponse
     * @throws AuthorizationException|SystemException|ConflictException|NotFoundException
     */
    public function create(CityCreateRequest $request, CityService $cityService) : JsonResponse
    {
        $this->authorize('manage', $this->auth->user());

        $data = $request->validateData();

        $city = $cityService->create($data);

        $cityMapper = new CityResource($city);

        return new JsonResponse($cityMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Update a city
     *
     * @param CityUpdateRequest $request
     * @param CityService $cityService
     * @return JsonResponse
     * @throws AuthorizationException|SystemException|ConflictException
     */
    public function edit(CityUpdateRequest $request, CityService $cityService) : JsonResponse
    {
        $this->authorize('manage', $this->auth->user());

        $data = $request->validateData();

        $city = $cityService->update($data);

        $cityMapper = new CityResource($city);

        return new JsonResponse($cityMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Delete a city
     *
     * @param CityDeleteRequest $request
     * @param CityService $cityService
     * @return JsonResponse
     * @throws AuthorizationException|SystemException
     */
    public function destroy(CityDeleteRequest $request, CityService $cityService) : JsonResponse
    {
        $this->authorize('manage', $this->auth->user());

        $data = $request->validateData();

        $cityService->delete($data);

        return new JsonResponse("City with id " . $data['id'] . " deleted successfully.", HttpStatusCode::HTTP_OK);
    }
}
