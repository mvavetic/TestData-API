<?php

namespace App\Repositories;

use App\Enums\HttpStatusCode;
use App\Events\RecordAdded;
use App\Exceptions\SystemException;
use App\Interfaces\ModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

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
     * @throws SystemException
     */
    public function create(array $data) : ModelInterface
    {
        try {
            $record = $this->model->create($data);
            event(new RecordAdded($this->model->getTable(), $record->id));
        } catch (QueryException $e) {
            throw new SystemException("Query failed.", HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $record;
    }

    /**
     * Update a record
     *
     * @param array $data
     * @return bool
     * @throws SystemException
     */
    public function update(array $data) : bool
    {
        try {
            $record = $this->model->update($data);
        } catch (QueryException $e) {
            throw new SystemException("Query failed.", HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $record;
    }

    /**
     * Delete a record
     *
     * @param int $id
     * @return bool
     * @throws SystemException
     */
    public function delete(int $id) : bool
    {
        try {
            $record = $this->model->destroy($id);
        } catch (QueryException $e) {
            throw new SystemException("Query failed.", HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $record;
    }

    /**
     * Retrieve wanted amount of records
     *
     * @param int $number
     * @return ModelInterface
     * @throws SystemException
     */
    public function paginate(int $number = 15) : ModelInterface
    {
        try {
            $query = $this->model->limit($number)->get();
        } catch (QueryException $e) {
            throw new SystemException("Query failed.", HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $query;
    }

    /**
     * Retrieve all records
     *
     * @return ModelInterface
     * @throws SystemException
     */
    public function findAll() : ModelInterface
    {
        try {
            $query = $this->model->get();
        } catch (QueryException $e) {
            throw new SystemException("Query failed.", HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $query;
    }

    /**
     * Retrieve a single record by ID
     *
     * @param int $id
     * @return ModelInterface
     * @throws SystemException
     */
    public function findById(int $id) : ModelInterface
    {
        try {
            $query = $this->model->find($id);
        } catch (QueryException $e) {
            throw new SystemException("Query failed.", HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $query;
    }
}