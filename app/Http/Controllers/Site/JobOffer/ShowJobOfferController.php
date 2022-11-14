<?php

namespace App\Http\Controllers\Site\JobOffer;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Resources\JobOfferResource;

class ShowJobOfferController
{
    public function __invoke(JobOffer $jobOffer)
    {
        return inertia('Site/JobOffer/Show', [
            'jobOffer' => new JobOfferResource($jobOffer->load('company', 'categories'))
        ]);
    }
}
