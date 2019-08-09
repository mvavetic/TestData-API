<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Repositories\BaseRepository;
use App\Models\Avatar;

class AvatarService
{
    /**
     * Model to be used
     *
     * @var Avatar
     */
    protected $avatarModel;

    /**
     * Repository for a model
     *
     * @var BaseRepository
     */
    protected $repository;

    /**
     * Setting the model to a protected variable
     *
     * @param Avatar $avatarModel
     */
    public function __construct(Avatar $avatarModel)
    {
        $this->avatarModel = $avatarModel;

        $this->repository = new BaseRepository($this->avatarModel);
    }

    /**
     * Create an avatar
     *
     * @param array $data
     * @return ModelInterface
     */
    public function create(array $data) : ModelInterface
    {
        return $this->repository->create($data);
    }

    /**
     * Update an avatar
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data) : bool
    {
        return $this->repository->update($data);
    }
}