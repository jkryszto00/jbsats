<?php

namespace App\Domain\JobOffer\Enums\Contract;

enum ContractCurrency: string
{
    case PLN = 'pln';
    case EUR = 'eur';
    case GBP = 'gbp';
    case USD = 'usd';
}
