<?php

namespace App\Services;

class Service
{
    /**
     * Converts given string to array of relations
     *
     * @param string $string
     * @return array
     */
    protected function makeRelationsArrayFromString(string $string) : array
    {
        return explode(', ', $string);
    }
}