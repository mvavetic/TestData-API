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
     * @throws
     */
    public function findAll() : ModelInterface
    {
        if (empty($data['load_with'])) {
            $countries = $this->repository->findAll();
        } else {
            $relations = explode(', ', $data['load_with']);
            $countries = $this->repository->findAllWithRelations($relations);
        }

        if ($countries->count() > null) {
            return $countries;
        } else {
            throw new NotFoundException('No countries found in database.', 404);
        }
    }

    /**
     * Get a single country
     *
     * @param int $id
     * @return ModelInterface
     * @throws
     */
    public function findById(int $id) : ModelInterface
    {
        return $countries = $this->repository->findById($id);
    }
}