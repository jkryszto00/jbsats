<?php

namespace App\Domain\JobOffer\Enums\Contract;

enum ContractPer: string
{
    case HOUR = 'hour';
    case DAY = 'day';
    case MONTH = 'month';
    case YEAR = 'year';
}
