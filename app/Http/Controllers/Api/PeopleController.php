<?php

namespace App\Http\Controllers\Api;

use App\Enums\ExceptionError;
use App\Http\Controllers\Controller;
use App\Repositories\PeopleRepository;
use App\Http\Resources\PeopleResource;
use App\Http\Requests\PeopleListRequest;
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

        if (! $people === null) {
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
}
