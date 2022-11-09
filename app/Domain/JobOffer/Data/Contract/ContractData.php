<?php

namespace App\Domain\JobOffer\Data\Contract;

use App\Domain\JobOffer\Enums\Contract\ContractCurrency;
use App\Domain\JobOffer\Enums\Contract\ContractTime;
use Spatie\LaravelData\Data;

class ContractData extends Data
{
    public function __construct(
        public readonly ContractCurrency $currency,
        public readonly ContractTime $time
    ){}
}
