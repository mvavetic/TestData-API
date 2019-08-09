<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Repositories\BaseRepository;
use App\Models\Sport;

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
     * @throws
     */
    public function findAll() : ModelInterface
    {
        return $sports = $this->repository->findAll();
    }
}