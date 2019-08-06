<?php

namespace App\Services;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeopleResource;
use App\Interfaces\ReturnTypeInterface;
use App\Models\Country;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\JsonResponse;
use App\Models\People;
use Illuminate\Validation\Factory as Validation;

class PeopleService extends Controller
{
    /**
     * Model to be used
     *
     * @var Country
     */
    protected $peopleModel;

    /**
     * Repository for a model
     *
     * @var BaseRepository
     */
    protected $repository;

    /**
     * Setting the model to a protected variable
     *
     * @param People $peopleModel
     * @param Response $response
     * @param Validation $validation
     */
    public function __construct(People $peopleModel, Response $response, Validation $validation)
    {
        $this->peopleModel = $peopleModel;

        $this->repository = new BaseRepository($this->peopleModel);

        parent::__construct($response, $validation);
    }

    /**
     * Get requested number of people
     *
     * @param array $data
     * @return ReturnTypeInterface
     * @throws
     */
    public function findAll(array $data) : ReturnTypeInterface
    {
        $people = $this->repository->paginate($data['count']);

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
     * Get a single person
     *
     * @param array $data
     * @return ReturnTypeInterface
     */
    public function findOne(array $data) : ReturnTypeInterface
    {
        $person = $this->repository->findById($data['id']);

        if ($data['data_format'] === DataFormat::JSON) {
            $peopleMapper = new PeopleResource($person);
            return new JsonResponse($peopleMapper, HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.people.info', compact('person'))->header('Content-Type', 'text/xml');
        }
    }

    /**
     * Create a person
     *
     * @param array $data
     * @return JsonResponse
     */
    public function create(array $data) : JsonResponse
    {
        $person = $this->repository->create($data);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Update a person
     *
     * @param array $data
     * @return JsonResponse
     */
    public function update(array $data) : JsonResponse
    {
        $person = $this->repository->update($data);

        $personMapper = new PeopleResource($person);

        return new JsonResponse($personMapper, HttpStatusCode::HTTP_OK);
    }

    /**
     * Delete a person
     *
     * @param array $data
     * @return JsonResponse
     */
    public function delete(array $data) : JsonResponse
    {
        $this->repository->delete($data['id']);

        return new JsonResponse("Person with id " . $data['id'] . " deleted successfully.", HttpStatusCode::HTTP_OK);
    }
}