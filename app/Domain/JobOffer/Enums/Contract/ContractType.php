<?php

namespace App\Domain\JobOffer\Enums\Contract;

enum ContractType: string
{
    case CONTRACT = 'contract';
    case B2B = 'b2b';
    case MANDATE = 'mandate';
}
