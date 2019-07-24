<?php

namespace App\Repositories;

use App\Models\People;

class PeopleRepository
{
    /**
     * Create a new person
     *
     * @param array $data
     * @return object
     */
    public function create(array $data)
    {
        $peopleModel = new People();

        $person = $peopleModel->create($data);

        return $person;
    }

    /**
     * Update a person
     *
     * @param array $data
     * @return object
     */
    public function update(array $data)
    {
        $person = $this->findById($data['id']);

        $person->update($data);

        return $person;
    }

    /**
     * Delete a person
     *
     * @param int $id
     * @return true
     */
    public function delete(int $id)
    {
        $person = $this->findById($id);

        $person->delete();

        return true;
    }

    /**
     * Get all people
     *
     * @param int $number
     * @return object
     */
    public function findAll(int $number)
    {
        $peopleModel = new People();

        $peopleList = $peopleModel->limit($number)->get();

        return $peopleList;
    }

    /**
     * Get a single person
     *
     * @param int $id
     * @return object
     */
    public function findById(int $id)
    {
        $peopleModel = new People();

        $person = $peopleModel->find($id);

        return $person;
    }
}