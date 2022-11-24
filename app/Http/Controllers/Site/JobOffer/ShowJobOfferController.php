<?php

namespace App\Http\Controllers\Site\JobOffer;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\ViewModels\ShowJobOfferViewModel;

class ShowJobOfferController
{
    public function __invoke(JobOffer $jobOffer)
    {
        return inertia('Site/JobOffer/Show', [
            'model' => new ShowJobOfferViewModel($jobOffer)
        ]);
    }
}
