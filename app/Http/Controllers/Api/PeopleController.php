<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PeopleService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PeopleListRequest;
use App\Http\Requests\PeopleInfoRequest;
use App\Http\Requests\PersonCreateRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Http\Requests\PersonDeleteRequest;

class PeopleController extends Controller
{
    /**
     * Get requested number of people
     *
     * @param \App\Http\Requests\PeopleListRequest $request
     * @param \App\Services\PeopleService $peopleService
     * @return mixed
     * @throws
     */
    public function index(PeopleListRequest $request, PeopleService $peopleService)
    {
        $data = $request->validateData();

        return $peopleService->findAll($data);
    }

    /**
     * Get a single person by id
     *
     * @param \App\Http\Requests\PeopleInfoRequest $request
     * @param \App\Services\PeopleService $peopleService
     * @return mixed
     */
    public function show(PeopleInfoRequest $request, PeopleService $peopleService)
    {
        $data = $request->validateData();

        return $peopleService->findOne($data);
    }

    /**
     * Create a new person
     *
     * @param \App\Http\Requests\PersonCreateRequest $request
     * @param \App\Services\PeopleService $peopleService
     * @return JsonResponse
     */
    public function create(PersonCreateRequest $request, PeopleService $peopleService) : JsonResponse
    {
        $data = $request->validateData();

        return $peopleService->create($data);
    }

    /**
     * Update a person
     *
     * @param \App\Http\Requests\PersonUpdateRequest $request
     * @param \App\Services\PeopleService $peopleService
     * @return JsonResponse
     */
    public function update(PersonUpdateRequest $request, PeopleService $peopleService) : JsonResponse
    {
        $data = $request->validateData();

        return $peopleService->update($data);
    }

    /**
     * Delete a person
     *
     * @param \App\Http\Requests\PersonDeleteRequest $request
     * @param \App\Services\PeopleService $peopleService
     * @return JsonResponse
     */
    public function destroy(PersonDeleteRequest $request, PeopleService $peopleService) : JsonResponse
    {
        $data = $request->validateData();

        return $peopleService->delete($data);
    }
}
