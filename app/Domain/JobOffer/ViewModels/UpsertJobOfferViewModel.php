<?php

namespace App\Domain\JobOffer\ViewModels;

use App\Domain\JobOffer\Data\CategoryData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Enums\Contract\ContractCurrency;
use App\Domain\JobOffer\Enums\Contract\ContractPer;
use App\Domain\JobOffer\Enums\Contract\ContractTime;
use App\Domain\JobOffer\Enums\Contract\ContractType;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Models\Category;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class UpsertJobOfferViewModel extends ViewModel
{
    public function __construct(
        public readonly ?JobOffer $jobOffer = null
    ){}

    public function jobOffer(): ?JobOfferData
    {
        if (!$this->jobOffer) {
            return null;
        }

        return JobOfferData::from($this->jobOffer->load('categories', 'contract', 'salaries'));
    }

    public function categories(): Collection
    {
        return Category::all()->map(fn (Category $category) => CategoryData::from($category));
    }

    public function levels(): Collection
    {
        return collect(JobOfferLevel::cases())->map(fn (JobOfferLevel $level) => [
            'name' => $level->text(),
            'value' => $level->value
        ]);
    }

    public function types(): Collection
    {
        return collect(ContractType::cases())->map(fn (ContractType $type) => $type);
    }

    public function times(): Collection
    {
        return collect(ContractTime::cases())->map(fn (ContractTime $time) => $time);
    }

    public function currencies(): Collection
    {
        return collect(ContractCurrency::cases())->map(fn (ContractCurrency $currency) => $currency);
    }

    public function pers(): Collection
    {
        return collect(ContractPer::cases())->map(fn (ContractPer $per) => $per);
    }
}
