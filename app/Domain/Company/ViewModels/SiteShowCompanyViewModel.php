<?php

namespace App\Domain\Company\ViewModels;

use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Models\Company;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\Shared\ViewModels\ViewModel;
use Spatie\LaravelData\DataCollection;

class SiteShowCompanyViewModel extends ViewModel
{
    public function __construct(
        public readonly Company $company
    ){}

    public function company(): CompanyData
    {
        return CompanyData::fromModel($this->company);
    }

    public function jobOffers(): DataCollection
    {
        return JobOfferData::collection($this->company->jobOffers->load('salaries', 'contract')->map(fn ($jobOffer) => JobOfferData::from($jobOffer)));
    }
}
