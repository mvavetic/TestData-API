<?php

namespace App\Repositories;

use App\Events\RecordAdded;
use App\Interfaces\ModelInterface;
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
     * @return ModelInterface
     */
    public function create(array $data) : ModelInterface
    {
        $record = $this->model->create($data);

        event(new RecordAdded($this->model->getTable(), $record->id));

        return $record;
    }

    /**
     * Update a record
     *
     * @param array $data
     * @return ModelInterface
     */
    public function update(array $data) : ModelInterface
    {
        $record = $this->model->find($data['id']);

        $record->update($data);

        return $record;
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
     * @return ModelInterface
     */
    public function paginate(int $number = 15) : ModelInterface
    {
        return $this->model->limit($number)->get();
    }

    /**
     * Retrieve all records
     *
     * @return ModelInterface
     */
    public function findAll() : ModelInterface
    {
       return $this->model->get();
    }

    /**
     * Retrieve a single record by ID
     *
     * @param int $id
     * @return ModelInterface
     */
    public function findById(int $id) : ModelInterface
    {
        return $this->model->find($id);
    }

    /**
     * Retrieve all with requested relations
     *
     * @param array $data
     * @return ModelInterface
     */
    public function findAllWithRelations(array $data) : ModelInterface
    {
        return $this->model->with($data)->get();
    }

    /**
     * Retrieve a single record by ID with requested relations
     *
     * @param array $data
     * @param int $id
     * @return ModelInterface
     */
    public function findOneWithRelations(array $data, int $id) : ModelInterface
    {
        return $this->model->with($data)->find($id);
    }
}