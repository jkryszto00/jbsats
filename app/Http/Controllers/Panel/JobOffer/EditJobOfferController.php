<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\ViewModels\UpsertJobOfferViewModel;
use App\Http\Controllers\Controller;

class EditJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer)
    {
        $this->authorize('update', $jobOffer);

        return inertia('Panel/JobOffer/Edit', [
            'model' => new UpsertJobOfferViewModel($jobOffer)
        ]);
    }
}
