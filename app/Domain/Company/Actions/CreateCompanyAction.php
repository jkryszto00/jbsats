<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Models\Company;
use App\Domain\Shared\Data\FileData;
use App\Domain\User\Data\UserData;

class CreateCompanyAction
{
    public static  function execute(UserData $owner, FileData $logo, CompanyData $companyData): Company
    {
        $company = Company::create([...$companyData->toArray(), 'owner_id' => $owner->id]);
        $company->media()->create($logo->toArray());

        return $company;
    }
}
