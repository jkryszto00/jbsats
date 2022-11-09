<?php

namespace App\Domain\JobOffer\Actions;

use App\Domain\Company\Models\Company;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;

class CreateJobOfferAction
{
    public function __invoke(Company $company, JobOfferData $jobOfferData): JobOffer
    {
        return JobOffer::create(array_merge(['company_id' => $company->id], $jobOfferData->toArray()));
    }
}
