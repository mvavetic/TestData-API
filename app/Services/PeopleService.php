<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
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
        if (empty($data['load_with'])) {
            $people = $this->repository->paginate($data['count']);
        } else {
            $relations = explode(', ', $data['load_with']);
            $people = $this->repository->findAllWithRelations($relations);
        }

        if ($people->count() > null) {
            return $people;
        } else {
            throw new NotFoundException('No people found in database.', 404);
        }
    }

    /**
     * Get all people with requested relations
     *
     * @param array $data
     * @return ModelInterface
     * @throws
     */
    public function findAllWithRelations(array $data) : ModelInterface
    {
        $people = $this->repository->findAllWithRelations($data);

        if ($people->count() > null) {
            return $people;
        } else {
            throw new NotFoundException('No people found in database.', 404);
        }
    }

    /**
     * Get a single person with requested relations
     *
     * @param array $data
     * @param int $id
     * @return ModelInterface
     * @throws
     */
    public function findOneWithRelations(array $data, int $id) : ModelInterface
    {
        return $person = $this->repository->findOneWithRelations($data, $id);
    }

    /**
     * Get a single person
     *
     * @param array $data
     * @return ModelInterface
     * @throws
     */
    public function findOne(array $data) : ModelInterface
    {
        if (empty($data['load_with'])) {
            $person = $this->repository->findOrFail($data['id']);
        } else {
            $relations = explode(', ', $data['load_with']);
            $person = $this->repository->findOneWithRelations($relations, $data['id']);
        }

        return $person;
    }

    /**
     * Create a person
     *
     * @param array $data
     * @return ModelInterface
     * @throws
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
     * @throws
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
     * @throws
     */
    public function delete(array $data) : bool
    {
        return $this->repository->delete($data['id']);
    }
}