<?php

namespace App\Domain\JobOffer\Actions;

use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;

class UpdateJobOfferAction
{
    public static function execute(JobOffer $jobOffer, JobOfferData $jobOfferData)
    {
        $jobOffer->update($jobOfferData->toArray());
        $jobOffer->categories()->sync(array_map(fn ($category) => $category['id'], $jobOfferData->category->toArray()));

        return $jobOffer;
    }
}
