<?php

namespace App\Services;

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
}