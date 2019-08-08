<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Repositories\BaseRepository;
use App\Models\City;

class CityService
{
    /**
     * Model to be used
     *
     * @var City
     */
    protected $cityModel;

    /**
     * Repository for a model
     *
     * @var BaseRepository
     */
    protected $repository;

    /**
     * Setting the model to a protected variable
     *
     * @param City $cityModel
     */
    public function __construct(City $cityModel)
    {
        $this->cityModel = $cityModel;

        $this->repository = new BaseRepository($this->cityModel);
    }

    /**
     * Get all cities
     *
     * @return ModelInterface
     */
    public function findAll() : ModelInterface
    {
        return $cities = $this->repository->findAll();
    }

    /**
     * Get a single city
     *
     * @param int $id
     * @return ModelInterface
     */
    public function findById(int $id) : ModelInterface
    {
        return $city = $this->repository->findById($id);
    }
}