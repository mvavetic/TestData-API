<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Exceptions\NotFoundException;
use App\Repositories\PeopleRepository;
use App\Http\Resources\PeopleResource;
use App\Http\Requests\PeopleListRequest;
use App\Http\Requests\PeopleInfoRequest;
use App\Http\Requests\PersonCreateRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Http\Requests\PersonDeleteRequest;
use App\Enums\HttpStatusCode;
use App\Enums\DataFormat;
use Psy\Util\Json;

class PeopleController extends Controller
{
    /**
     * Get requested number of people
     *
     * @param \App\Http\Requests\PeopleListRequest $request
     * @param \App\Repositories\PeopleRepository $peopleRepository
     * @return object
     * @throws NotFoundException
     */
    public function index(PeopleListRequest $request, PeopleRepository $peopleRepository) : object
    {
        $data = $request->validateData();

        $people = $peopleRepository->findAll($data['count']);

        if ($people->count() > null) {
            if ($data['data_format'] === DataFormat::JSON) {
                $peopleMapper = new PeopleResource($people);
                return new JsonResponse($peopleMapper->collection($people), HttpStatusCode::HTTP_OK);
            } elseif ($data['data_format'] === DataFormat::XML) {
                $xmlResponse = $this->responseFactory->view('XML.people.list', compact('people'))->header('Content-Type', 'text/xml');
                return $xmlResponse;
            }
        } else {
            throw new NotFoundException('No people found in database.', HttpStatusCode::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get a single person by id
     *
     * @param \App\Http\Requests\PeopleInfoRequest $request
     * @param \App\Repositories\PeopleRepository $peopleRepository
     * @return object
     * @throws NotFoundException
     */
    public function show(PeopleInfoRequest $request, PeopleRepository $peopleRepository) : object
    {
        $data = $request->validateData();

        $person = $peopleRepository->findById($data['id']);

        if ($person) {
            if ($data['data_format'] === DataFormat::JSON) {
                $peopleMapper = new PeopleResource($person);
                return new JsonResponse($peopleMapper, HttpStatusCode::HTTP_OK);
            } elseif ($data['data_format'] === DataFormat::XML) {
                $xmlResponse = $this->responseFactory->view('XML.people.info', compact('person'))->header('Content-Type', 'text/xml');
                return $xmlResponse;
            }
        } else {
            throw new NotFoundException('Person not found.', HttpStatusCode::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Create a new person
     *
     * @param \App\Http\Requests\PersonCreateRequest $request
     * @param \App\Repositories\PeopleRepository $peopleRepository
     * @return JsonResponse
     */
    public function create(PersonCreateRequest $request, PeopleRepository $peopleRepository) : JsonResponse
    {
        $data = $request->validateData();

        $person = $peopleRepository->create($data);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Update a person
     *
     * @param \App\Http\Requests\PersonUpdateRequest $request
     * @param \App\Repositories\PeopleRepository $peopleRepository
     * @return JsonResponse
     */
    public function update(PersonUpdateRequest $request, PeopleRepository $peopleRepository) : JsonResponse
    {
        $data = array_filter($request->validateData());

        $person = $peopleRepository->update($data);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Delete a person
     *
     * @param \App\Http\Requests\PersonDeleteRequest $request
     * @param \App\Repositories\PeopleRepository $peopleRepository
     * @return JsonResponse
     */
    public function destroy(PersonDeleteRequest $request, PeopleRepository $peopleRepository) : JsonResponse
    {
        $data = $request->validateData();

        $peopleRepository->delete($data['id']);

        return new JsonResponse("Person with id " . $data['id'] . " deleted successfully.", HttpStatusCode::HTTP_OK);
    }
}
