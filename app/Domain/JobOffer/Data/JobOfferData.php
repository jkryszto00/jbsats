<?php

namespace App\Domain\JobOffer\Data;

use App\Domain\Company\Data\CompanyData;
use App\Domain\JobOffer\Data\Contract\ContractData;
use App\Domain\JobOffer\Data\Contract\SalaryData;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Enums\JobOfferStatus;
use DateTimeImmutable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

class JobOfferData extends Data
{
    public function __construct(
        public readonly int|Optional $id,
        public readonly CompanyData|Optional $company,
        public readonly string $title,
        public readonly string $description,
        public readonly JobOfferLevel $level,
        public readonly ContractData $contract,
        #[DataCollectionOf(SalaryData::class)]
        public readonly DataCollection $salary,
        public readonly JobOfferStatus|Optional $status,
        public readonly DateTimeImmutable|Optional $expired_at
    ){}
}
