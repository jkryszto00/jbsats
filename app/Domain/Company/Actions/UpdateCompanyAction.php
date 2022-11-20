<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Models\Company;

class UpdateCompanyAction
{
    public static function execute(Company $company, CompanyData $data): Company
    {
        $company->update($data->toArray());
        return $company;
    }
}
