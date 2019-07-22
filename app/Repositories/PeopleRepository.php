<?php

namespace App\Repositories;

use App\Models\People;

class PeopleRepository
{
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