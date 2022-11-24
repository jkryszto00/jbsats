<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\ViewModels\UpsertJobOfferViewModel;

class CreateJobOfferController
{
    public function __invoke()
    {
        return inertia('Panel/JobOffer/Create', [
            'model' => new UpsertJobOfferViewModel()
        ]);
    }
}
