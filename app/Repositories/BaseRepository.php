<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
     * @return object
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a record
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return $this->model->update($data);
    }

    /**
     * Delete a record
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Retrieve wanted amount of records
     *
     * @param int $number
     * @return Collection
     */
    public function paginate(int $number = 15)
    {
        return $this->model->limit($number)->get();
    }

    /**
     * Retrieve all records
     *
     * @return Collection
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Retrieve a single record by ID
     *
     * @param int $id
     * @return object
     */
    public function findById(int $id)
    {
        return $this->model->find($id);
    }
}