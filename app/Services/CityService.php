<?php

namespace App\Services;

use App\Enums\ExceptionError;
use App\Enums\HttpStatusCode;
use App\Exceptions\ConflictException;
use App\Exceptions\NotFoundException;
use App\Exceptions\SystemException;
use App\Interfaces\ModelInterface;
use App\Repositories\BaseRepository;
use App\Models\City;
use App\Models\Country;
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

    /**
     * Create a city
     *
     * @param array $data
     * @return ModelInterface
     * @throws SystemException|ConflictException|NotFoundException
     */
    public function create(array $data) : ModelInterface
    {
        $countryModel = new Country();

        try {
            if(! $this->cityModel->where('name', $data['name'])->exists()) {
                if ($country = $countryModel->where('code', $data['country_code'])->first()) {
                    $data['country_id'] = $country->id;
                    return $this->repository->create($data);
                } else {
                    throw new NotFoundException(ExceptionError::ERR_COUNTRY_NOT_FOUND, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else {
                throw new ConflictException(ExceptionError::ERR_CONFLICT, HttpStatusCode::HTTP_CONFLICT);
            }
        } catch(QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update a city
     *
     * @param array $data
     * @return bool
     * @throws SystemException|ConflictException
     */
    public function update(array $data) : bool
    {
        try {
            if($this->cityModel->where('name', $data['name'])->exists()) {
                throw new ConflictException(ExceptionError::ERR_CONFLICT, HttpStatusCode::HTTP_CONFLICT);
            } else {
                return $this->repository->delete($data['id']);
            }
        } catch(QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a city
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