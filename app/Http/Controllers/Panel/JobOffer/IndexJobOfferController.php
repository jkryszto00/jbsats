<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Resources\JobOfferResource;
use App\Http\Controllers\Controller;

class IndexJobOfferController extends Controller
{
    public function __invoke()
    {
        return inertia('Panel/JobOffer/Index', [
            'jobOffers' => JobOfferResource::collection(JobOffer::all())
        ]);
    }
}
