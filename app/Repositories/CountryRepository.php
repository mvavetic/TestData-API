<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    /*
     * Get all countries
     *
     * @return object
     */
    public function findAll()
    {
        $countryModel = new Country();

        $countriesList = $countryModel->get();

        return $countriesList;
    }

    /**
     * Get a single country
     *
     * @param int $id
     * @return object
     */
    public function findById(int $id)
    {
        $countryModel = new Country();

        $country = $countryModel->find($id);

        return $country;
    }
}