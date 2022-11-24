<?php

namespace App\Domain\JobOffer\Data;

use App\Domain\JobOffer\Enums\Contract\ContractPer;
use App\Domain\JobOffer\Enums\Contract\ContractType;
use Spatie\LaravelData\Data;

class SalaryData extends Data
{
    public function __construct(
        public readonly ContractType $type,
        public readonly int $from,
        public readonly int $to,
        public readonly ContractPer $per
    ){}
}
