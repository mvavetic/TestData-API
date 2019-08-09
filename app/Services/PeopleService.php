<?php

namespace App\Services;

use App\Enums\ExceptionError;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Exceptions\SystemException;
use App\Interfaces\ModelInterface;
use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Models\People;
use Illuminate\Database\QueryException;

class PeopleService extends Service
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
     */
    public function __construct(People $peopleModel)
    {
        $this->peopleModel = $peopleModel;

        $this->repository = new BaseRepository($this->peopleModel);
    }

    /**
     * Get requested number of people
     *
     * @param array $data
     * @return ModelInterface
     * @throws SystemException|NotFoundException
     */
    public function findAll(array $data) : ModelInterface
    {
        try {
            if (empty($data['load_with'])) {
                $people = $this->repository->paginate($data['count']);
            } else {
                $relations = $this->makeRelationsArrayFromString($data['load_with']);
                $people = $this->repository->findAllWithRelations($relations);
            }
        } catch (QueryException $e) {
            throw new SystemException("Query failed.", HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($people->count() > null) {
            return $people;
        } else {
            throw new NotFoundException('No people found in database.', 404);
        }
    }

    /**
     * Get a single person
     *
     * @param array $data
     * @return ModelInterface
     * @throws SystemException
     */
    public function findOne(array $data) : ModelInterface
    {
        try {
            if (empty($data['load_with'])) {
                $person = $this->repository->findOrFail($data['id']);
            } else {
                $relations = $this->makeRelationsArrayFromString($data['load_with']);
                $person = $this->repository->findOneWithRelations($relations, $data['id']);
            }
        } catch (QueryException $e) {
            throw new SystemException("Query failed.", HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $person;
    }

    /**
     * Create a person
     *
     * @param array $data
     * @return ModelInterface
     * @throws SystemException
     */
    public function create(array $data) : ModelInterface
    {
        try {
            return $this->repository->create($data);
        } catch(QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update a person
     *
     * @param array $data
     * @return bool
     * @throws SystemException
     */
    public function update(array $data) : bool
    {
        try {
            return $this->repository->update($data);
        } catch(QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a person
     *
     * @param array $data
     * @return bool
     * @throws SystemException
     */
    public function delete(array $data) : bool
    {
        try {
            return $this->repository->delete($data['id']);
        } catch(QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}