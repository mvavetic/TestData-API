<?php

namespace App\Services;

use App\Enums\ExceptionError;
use App\Enums\HttpStatusCode;
use App\Exceptions\SystemException;
use App\Interfaces\ModelInterface;
use App\Repositories\BaseRepository;
use App\Models\Sport;
use Illuminate\Database\QueryException;

class SportService
{
    /**
     * Model to be used
     *
     * @var Sport
     */
    protected $sportModel;

    /**
     * Repository for a model
     *
     * @var BaseRepository
     */
    protected $repository;

    /**
     * Setting the model to a protected variable
     *
     * @param Sport $sportModel
     */
    public function __construct(Sport $sportModel)
    {
        $this->sportModel = $sportModel;

        $this->repository = new BaseRepository($this->sportModel);
    }

    /**
     * Get all sports
     *
     * @return ModelInterface
     * @throws SystemException
     */
    public function findAll() : ModelInterface
    {
        try {
            return $this->repository->findAll();
        } catch (QueryException $e) {
            throw new SystemException(ExceptionError::ERR_FATAL, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}