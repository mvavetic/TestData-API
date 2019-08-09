<?php

namespace App\Services;

class Service
{
    protected function makeRelationsArrayFromString(string $string)
    {
        return explode(', ', $string);
    }
}