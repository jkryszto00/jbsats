<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Models\Company;
use App\Domain\User\Data\UserData;

class CreateCompanyAction
{
    public function __invoke(UserData $owner, CompanyData $companyData): Company
    {
        return Company::create(array_merge($companyData->toArray(), ['owner_id' => $owner->id]));
    }
}
