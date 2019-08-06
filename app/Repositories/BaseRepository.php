<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * Model to be used
     *
     * @var Model
     */
    protected $model;

    /**
     * Assigning the model to the protected variable
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new record
     *
     * @param array $data
     * @return BaseRepositoryInterface
     */
    public function create(array $data) : BaseRepositoryInterface
    {
        return $this->model->create($data);
    }

    /**
     * Update a record
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data) : bool
    {
        return $this->model->update($data);
    }

    /**
     * Delete a record
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool
    {
        return $this->model->destroy($id);
    }

    /**
     * Retrieve wanted amount of records
     *
     * @param int $number
     * @return BaseRepositoryInterface
     */
    public function paginate(int $number = 15) : BaseRepositoryInterface
    {
        return $this->model->limit($number)->get();
    }

    /**
     * Retrieve all records
     *
     * @return BaseRepositoryInterface
     */
    public function findAll() : BaseRepositoryInterface
    {
        return $this->model->get();
    }

    /**
     * Retrieve a single record by ID
     *
     * @param int $id
     * @return BaseRepositoryInterface
     */
    public function findById(int $id) : BaseRepositoryInterface
    {
        return $this->model->find($id);
    }
}