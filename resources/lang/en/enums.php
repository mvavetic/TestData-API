<?php

use App\Enums\ExceptionError;

return [

    ExceptionError::class => [
        ExceptionError::ERR_PEOPLE_NOT_FOUND => 'No people found in database.',
        ExceptionError::ERR_PERSON_NOT_FOUND => "This person doesn't exist"
    ],

];