<?php

use App\Enums\ExceptionError;

return [

    ExceptionError::class => [
        ExceptionError::ERR_PEOPLE_NOT_FOUND => "No people found in database.",
        ExceptionError::ERR_PERSON_NOT_FOUND => "This person doesn't exist.",
        ExceptionError::ERR_CITIES_NOT_FOUND => "No cities found in database.",
        ExceptionError::ERR_COUNTRIES_NOT_FOUND => "No countries found in database.",
        ExceptionError::ERR_COUNTRY_NOT_FOUND => "This country doesn't exist.",
        ExceptionError::ERR_CONFLICT => "Conflict error. Similar data already exists in database.",
        ExceptionError::ERR_FATAL => "Query failed.",
    ],

];