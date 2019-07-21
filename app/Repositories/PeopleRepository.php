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
    public function findAll(int $number) : object
    {
        $peopleModel = new People();

        $peopleList = $peopleModel->limit($number)->get();

        return $peopleList;
    }
}