<?php

namespace App\Services;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeopleResource;
use App\Repositories\PeopleRepository;
use Illuminate\Http\JsonResponse;

class PeopleService extends Controller
{
    public function findAll(array $data)
    {
        $peopleRepository = new PeopleRepository();

        $people = $peopleRepository->findAll($data['count']);

        if ($people->count() > null) {
            if ($data['data_format'] === DataFormat::JSON) {
                $peopleResource = new PeopleResource($people);
                $filter = $data['loadWith'] === 'country' ? $peopleResource->collection($people) : $peopleResource->makeHidden('country');
                return new JsonResponse($filter, HttpStatusCode::HTTP_OK);
            } elseif ($data['data_format'] === DataFormat::XML) {
                $xmlFilter = $people->except('country');
                $xmlResponse = $this->responseFactory->view('XML.people.list', compact('xmlFilter'))->header('Content-Type', 'text/xml');
                return $xmlResponse;
            }
        } else {
            throw new NotFoundException('No people found in database.', HttpStatusCode::HTTP_BAD_REQUEST);
        }
    }
}