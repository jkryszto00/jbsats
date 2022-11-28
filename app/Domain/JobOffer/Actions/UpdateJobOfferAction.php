<?php

namespace App\Domain\JobOffer\Actions;

use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;
use Illuminate\Support\Facades\DB;

class UpdateJobOfferAction
{
    public static function execute(JobOffer $jobOffer, JobOfferData $jobOfferData)
    {
        return DB::transaction(function () use ($jobOffer, $jobOfferData) {
            $jobOffer->update($jobOfferData->toArray());
            $jobOffer->categories()->sync(array_map(fn ($category) => $category['id'], $jobOfferData->categories->toArray()));

            $jobOffer->contract()->update($jobOfferData->contract->toArray());

            $jobOffer->salaries()->delete();
            $jobOffer->salaries()->createMany($jobOfferData->salaries->toArray());

            return $jobOffer;
        });
    }
}
