<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Models\People;

class PeopleService
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
     * @throws
     */
    public function findAll(array $data) : ModelInterface
    {
        return $people = $this->repository->paginate($data['count']);
    }

    /**
     * Get a single person
     *
     * @param array $data
     * @return ModelInterface
     */
    public function findOne(array $data) : ModelInterface
    {
        return $person = $this->repository->findById($data['id']);
    }

    /**
     * Create a person
     *
     * @param array $data
     * @return ModelInterface
     */
    public function create(array $data) : ModelInterface
    {
        return $person = $this->repository->create($data);
    }

    /**
     * Update a person
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data) : bool
    {
        return $person = $this->repository->update($data);
    }

    /**
     * Delete a person
     *
     * @param array $data
     * @return bool
     */
    public function delete(array $data) : bool
    {
        return $this->repository->delete($data['id']);
    }
}