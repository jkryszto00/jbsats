<?php

namespace App\Domain\Company\ViewModels;

use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Models\Company;
use App\Domain\Shared\ViewModels\ViewModel;
use Spatie\LaravelData\DataCollection;

class SiteCompanyCollectionViewModel extends ViewModel
{
    public function companies(): DataCollection
    {
        return CompanyData::collection(Company::withCount('jobOffers')->get()->map(fn ($company) => CompanyData::fromModel($company)));
    }
}
