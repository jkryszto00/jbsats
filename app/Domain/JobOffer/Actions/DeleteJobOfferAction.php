<?php

namespace App\Domain\JobOffer\Actions;

use App\Domain\JobOffer\Models\JobOffer;

class DeleteJobOfferAction
{
    public static function execute(JobOffer $jobOffer): bool
    {
        $jobOffer->categories()->detach();
        return $jobOffer->delete();
    }
}
