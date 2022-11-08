<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Models\Company;

class UpdateCompanyAction
{
    public function __invoke(Company $company, CompanyData $companyData): bool
    {
        return $company->update($companyData->toArray());
    }
}
