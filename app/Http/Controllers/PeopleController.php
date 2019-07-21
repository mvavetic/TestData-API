<?php

namespace App\Http\Controllers;

use App\Repository\PeopleRepository;
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
     * @param \App\Repository\PeopleRepository $peopleRepository
     * @param \App\Http\Requests\PeopleListRequest $request
     * @return object
     */
    public function index(PeopleRepository $peopleRepository, PeopleListRequest $request) : object
    {
        $data = $request->validateData();

        $people = $peopleRepository->findAll($data['count']);

        if ($people) {
            $peopleMapper = new PeopleResource($people);
            if ($data['data_format'] === DataFormat::JSON) {
                return new JsonResponse($peopleMapper->collection($people), HttpStatusCode::HTTP_OK);
            } elseif ($data['data_format'] === DataFormat::XML) {
                $xmlResponse = $this->responseFactory->view('xml', compact('people'))->header('Content-Type', 'text/xml');
                return $xmlResponse;
            } else {
                return new JsonResponse("Only JSON and XML are acceptable data formats.", HttpStatusCode::HTTP_BAD_REQUEST);
            }
        } else {
            return new JsonResponse("No people found in database.", HttpStatusCode::HTTP_BAD_REQUEST);
        }
    }
}
