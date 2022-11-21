<?php

namespace App\Domain\JobOffer\Actions;

use App\Domain\Company\Models\Company;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;

class CreateJobOfferAction
{
    public static function execute(Company $company, JobOfferData $jobOfferData): JobOffer
    {
        $jobOffer = JobOffer::create(array_merge(['company_id' => $company->id], $jobOfferData->toArray()));
        $jobOffer->categories()->attach(array_map(fn ($category) => $category['id'], $jobOfferData->category->toArray()));

        return $jobOffer;
    }
}
