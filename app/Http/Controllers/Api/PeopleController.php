<?php

namespace App\Http\Controllers\Api;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeopleResource;
use App\Interfaces\ReturnTypeInterface;
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
     * @return ReturnTypeInterface
     * @throws
     */
    public function index(PeopleListRequest $request, PeopleService $peopleService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        $people = $peopleService->findAll($data);

        if ($people->count() > null) {
            if ($data['data_format'] === DataFormat::JSON) {
                $peopleResource = new PeopleResource($people);
                $filter = $data['loadWith'] === 'country' ? $peopleResource->collection($people) : $peopleResource->makeHidden('country');
                return new JsonResponse($filter, HttpStatusCode::HTTP_OK);
            } elseif ($data['data_format'] === DataFormat::XML) {
                return $this->responseFactory->view('XML.people.list', compact('people'))->header('Content-Type', 'text/xml');
            }
        } else {
            throw new NotFoundException('No people found in database.', HttpStatusCode::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get a single person by id
     *
     * @param \App\Http\Requests\PeopleInfoRequest $request
     * @param \App\Services\PeopleService $peopleService
     * @return ReturnTypeInterface
     */
    public function show(PeopleInfoRequest $request, PeopleService $peopleService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        $person = $peopleService->findOne($data);

        if ($data['data_format'] === DataFormat::JSON) {
            $peopleMapper = new PeopleResource($person);
            return new JsonResponse($peopleMapper, HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.people.info', compact('person'))->header('Content-Type', 'text/xml');
        }
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

        $person = $peopleService->create($data);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
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

        $person = $peopleService->update($data);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
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

        $peopleService->delete($data);

        return new JsonResponse("Person with id " . $data['id'] . " deleted successfully.", HttpStatusCode::HTTP_OK);
    }
}
