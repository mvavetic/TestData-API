<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ExceptionError extends Enum implements LocalizedEnum
{
    const ERR_PEOPLE_NOT_FOUND = "ERR_PEOPLE_NOT_FOUND";
}
