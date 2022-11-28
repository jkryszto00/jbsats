<?php

namespace App\Domain\JobOffer\Data;

use App\Domain\Company\Data\CompanyData;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Enums\JobOfferStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        #[DataCollectionOf(CategoryData::class)]
        public readonly DataCollection|Optional $categories,
        public readonly LevelData $level,
        public readonly ContractData|Optional $contract,
        #[DataCollectionOf(SalaryData::class)]
        public readonly DataCollection|Optional $salaries,
        public readonly JobOfferStatus|Optional $status,
        public readonly Carbon|Optional|null $expired_at
    ){}

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
            'categories' => CategoryData::collection(array_map(fn ($category) => CategoryData::from($category), $request->input('category'))),
            'level' => LevelData::from([
                'name' => JobOfferLevel::tryFrom($request->input('level'))->text(),
                'value' => JobOfferLevel::tryFrom($request->input('level'))->value
            ]),
            'contract' => ContractData::from($request->input('contract')),
            'salaries' => SalaryData::collection(array_map(fn ($salary) => SalaryData::from($salary), $request->input('salary')))
        ]);
    }
}
