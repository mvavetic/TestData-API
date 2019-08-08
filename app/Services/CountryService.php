<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Interfaces\ModelInterface;
use App\Repositories\BaseRepository;
use App\Models\Country;

class CountryService
{
    /**
     * Model to be used
     *
     * @var Country
     */
    protected $countryModel;

    /**
     * Repository for a model
     *
     * @var BaseRepository
     */
    protected $repository;

    /**
     * Setting the model to a protected variable
     *
     * @param Country $countryModel
     */
    public function __construct(Country $countryModel)
    {
        $this->countryModel = $countryModel;

        $this->repository = new BaseRepository($this->countryModel);
    }

    /**
     * Get all countries
     *
     * @return ModelInterface
     */
    public function findAll() : ModelInterface
    {
        return $countries = $this->repository->findAll();
    }

    /**
     * Get a single country
     *
     * @param int $id
     * @return ModelInterface
     */
    public function findById(int $id) : ModelInterface
    {
        return $countries = $this->repository->findById($id);
    }

    /**
     * Get all countries with requested relations
     *
     * @param array $data
     * @return ModelInterface
     * @throws
     */
    public function findAllWithRelations(array $data) : ModelInterface
    {
        $country = $this->repository->findAllWithRelations($data);

        if ($country->count() > null) {
            return $country;
        } else {
            throw new NotFoundException('No people found in database.', 404);
        }
    }

    /**
     * Get a single country with requested relations
     *
     * @param array $data
     * @param int $id
     * @return ModelInterface
     * @throws
     */
    public function findOneWithRelations(array $data, int $id) : ModelInterface
    {
        return $country = $this->repository->findOneWithRelations($data, $id);
    }
}