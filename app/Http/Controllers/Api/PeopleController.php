<?php

namespace App\Http\Controllers\Api;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Exceptions\SystemException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarCreateRequest;
use App\Http\Resources\PeopleResource;
use App\Interfaces\ReturnTypeInterface;
use App\Services\AvatarService;
use App\Services\PeopleService;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws SystemException|NotFoundException
     */
    public function index(PeopleListRequest $request, PeopleService $peopleService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        $people = $peopleService->findAll($data);

        if ($data['data_format'] === DataFormat::JSON) {
            $peopleResource = new PeopleResource($people);
            return new JsonResponse($peopleResource->collection($people), HttpStatusCode::HTTP_OK);

        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.people.list', compact('people'))->header('Content-Type', 'text/xml');
        }
    }

    /**
     * Get a single person by id
     *
     * @param \App\Http\Requests\PeopleInfoRequest $request
     * @param \App\Services\PeopleService $peopleService
     * @return ReturnTypeInterface
     * @throws SystemException|NotFoundException
     */
    public function show(PeopleInfoRequest $request, PeopleService $peopleService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        $person = $peopleService->findOne($data);

        if ($data['data_format'] === DataFormat::JSON) {
            $personResource = new PeopleResource($person);
            return new JsonResponse($personResource, HttpStatusCode::HTTP_OK);

        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.people.info', compact('person'))->header('Content-Type', 'text/xml');
        }
    }

    /**
     * Create a new person
     *
     * @param \App\Http\Requests\PersonCreateRequest $personRequest
     * @param AvatarCreateRequest $avatarRequest
     * @param \App\Services\PeopleService $peopleService
     * @param AvatarService $avatarService
     * @return JsonResponse
     * @throws AuthorizationException|SystemException
     */
    public function create(PersonCreateRequest $personRequest, AvatarCreateRequest $avatarRequest, PeopleService $peopleService, AvatarService $avatarService) : JsonResponse
    {
        $this->authorize('manage', $this->auth->user());

        $personData = $personRequest->validateData();

        $person = $peopleService->create($personData);

        $avatarData = $avatarRequest->validateData();

        $header_response = get_headers($avatarData['image_url'], 1);

        if (strpos($header_response[0], "404") !== true) {
            $avatarData['person_id'] = $person->id;
            $avatarService->create($avatarData);
        }

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Update a person
     *
     * @param \App\Http\Requests\PersonUpdateRequest $personRequest
     * @param \App\Services\PeopleService $peopleService
     * @param \App\Http\Requests\AvatarCreateRequest $avatarRequest
     * @param \App\Services\AvatarService $avatarService
     * @return JsonResponse
     * @throws AuthorizationException|SystemException
     */
    public function edit(PersonUpdateRequest $personRequest, AvatarCreateRequest $avatarRequest, AvatarService $avatarService, PeopleService $peopleService) : JsonResponse
    {
        $this->authorize('manage', $this->auth->user());

        $personData = $personRequest->validateData();

        $avatarData = $avatarRequest->validateData();

        ! $avatarData['image_url'] ? null : $avatarService->update($avatarData);

        $person = $peopleService->update($personData);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Delete a person
     *
     * @param \App\Http\Requests\PersonDeleteRequest $request
     * @param \App\Services\PeopleService $peopleService
     * @return JsonResponse
     * @throws AuthorizationException|SystemException
     */
    public function destroy(PersonDeleteRequest $request, PeopleService $peopleService) : JsonResponse
    {
        $this->authorize('manage', $this->auth->user());

        $data = $request->validateData();

        $peopleService->delete($data);

        return new JsonResponse("Person with id " . $data['id'] . " deleted successfully.", HttpStatusCode::HTTP_OK);
    }
}
