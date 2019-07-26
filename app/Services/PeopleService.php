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
    /**
     * Get requested number of people
     *
     * @param array $data
     * @return mixed
     * @throws
     */
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
                $xmlResponse = $this->responseFactory->view('XML.people.list', compact('people'))->header('Content-Type', 'text/xml');
                return $xmlResponse;
            }
        } else {
            throw new NotFoundException('No people found in database.', HttpStatusCode::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get a single person
     *
     * @param array $data
     * @return mixed
     */
    public function findOne(array $data)
    {
        $peopleRepository = new PeopleRepository();

        $person = $peopleRepository->findById($data['id']);

        if ($data['data_format'] === DataFormat::JSON) {
            $peopleMapper = new PeopleResource($person);
            return new JsonResponse($peopleMapper, HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            $xmlResponse = $this->responseFactory->view('XML.people.info', compact('person'))->header('Content-Type', 'text/xml');
            return $xmlResponse;
        }
    }

    /**
     * Create a person
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $peopleRepository = new PeopleRepository();

        $person = $peopleRepository->create($data);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Update a person
     *
     * @param array $data
     * @return mixed
     */
    public function update(array $data)
    {
        $peopleRepository = new PeopleRepository();

        $person = $peopleRepository->update($data);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Delete a person
     *
     * @param array $data
     * @return mixed
     */
    public function delete(array $data)
    {
        $peopleRepository = new PeopleRepository();

        $peopleRepository->delete($data['id']);

        return new JsonResponse("Person with id " . $data['id'] . " deleted successfully.", HttpStatusCode::HTTP_OK);

    }
}