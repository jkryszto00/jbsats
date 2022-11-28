<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\ViewModels\UpsertJobOfferViewModel;
use App\Http\Controllers\Controller;

class CreateJobOfferController extends Controller
{
    public function __invoke()
    {
        $this->authorize('create', JobOffer::class);

        return inertia('Panel/JobOffer/Create', [
            'model' => new UpsertJobOfferViewModel()
        ]);
    }
}
