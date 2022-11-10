<?php

namespace App\Domain\JobOffer\Data\Contract;

use App\Domain\JobOffer\Enums\Contract\ContractPer;
use App\Domain\JobOffer\Enums\Contract\ContractType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SalaryData extends Data
{
    public function __construct(
        public readonly ContractType $type,
        public readonly int|Optional $from,
        public readonly int|Optional $to,
        public readonly int|Optional $exact,
        public readonly ContractPer $per
    ){}
}
