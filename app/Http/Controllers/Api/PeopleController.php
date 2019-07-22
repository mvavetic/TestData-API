<?php

namespace App\Http\Controllers\Api;

use App\Enums\ExceptionError;
use App\Http\Controllers\Controller;
use App\Repositories\PeopleRepository;
use App\Http\Resources\PeopleResource;
use App\Http\Requests\PeopleListRequest;
use App\Http\Requests\PeopleInfoRequest;
use Illuminate\Http\JsonResponse;
use App\Enums\HttpStatusCode;
use App\Enums\DataFormat;

class PeopleController extends Controller
{
    /**
     * Get requested number of people
     *
     * @param \App\Http\Requests\PeopleListRequest $request
     * @param \App\Repositories\PeopleRepository $peopleRepository
     * @return object
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
            return new JsonResponse(ExceptionError::getDescription(ExceptionError::ERR_PEOPLE_NOT_FOUND), HttpStatusCode::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get a single person by id
     *
     * @param \App\Http\Requests\PeopleInfoRequest $request
     * @param \App\Repositories\PeopleRepository $peopleRepository
     * @return object
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
            return new JsonResponse(ExceptionError::getDescription(ExceptionError::ERR_PERSON_NOT_FOUND), HttpStatusCode::HTTP_BAD_REQUEST);
        }
    }
}
