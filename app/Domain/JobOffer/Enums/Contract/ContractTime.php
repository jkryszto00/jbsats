<?php

namespace App\Domain\JobOffer\Enums\Contract;

enum ContractTime: string
{
    case PERMAMENT = 'permament';
    case TEMPORARY = 'temporary';
}
