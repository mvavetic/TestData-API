<?php

namespace App\Services;

use App\Enums\ExceptionError;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Exceptions\SystemException;
use App\Interfaces\ModelInterface;
use App\Repositories\BaseRepository;
use App\Models\City;
use Illuminate\Database\QueryException;

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
     * @throws
     */
    public function findAll() : ModelInterface
    {
        try {
            $cities = $this->repository->findAll();
        } catch (QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($cities->count() > null) {
            return $cities;
        } else {
            throw new NotFoundException(ExceptionError::ERR_CITIES_NOT_FOUND, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get a single city
     *
     * @param int $id
     * @return ModelInterface
     * @throws
     */
    public function findById(int $id) : ModelInterface
    {
        try {
            return $this->repository->findById($id);
        } catch (QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}