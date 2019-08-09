<?php

namespace App\Services;

use App\Enums\ExceptionError;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Exceptions\SystemException;
use App\Interfaces\ModelInterface;
use App\Repositories\BaseRepository;
use App\Models\Country;
use Illuminate\Database\QueryException;

class CountryService extends Service
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
     * @param array $data
     * @return ModelInterface
     * @throws SystemException|NotFoundException
     */
    public function findAll(array $data) : ModelInterface
    {
        try {
            if (empty($data['load_with'])) {
                $countries = $this->repository->findAll();
            } else {
                $relations = $this->makeRelationsArrayFromString($data['load_with']);
                $countries = $this->repository->findAllWithRelations($relations);
            }
        } catch (QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($countries->count() > null) {
            return $countries;
        } else {
            throw new NotFoundException(ExceptionError::ERR_COUNTRIES_NOT_FOUND, HttpStatusCode::HTTP_NOT_FOUND);
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
        try {
            return $this->repository->findById($id);
        } catch (QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}