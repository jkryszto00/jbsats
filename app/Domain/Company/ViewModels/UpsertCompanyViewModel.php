<?php

namespace App\Domain\Company\ViewModels;

use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Models\Company;
use App\Domain\Shared\ViewModels\ViewModel;

class UpsertCompanyViewModel extends ViewModel
{
    public function __construct(
        public readonly Company $company
    ){}

    public function company(): CompanyData
    {
        return CompanyData::fromModel($this->company);
    }
}
